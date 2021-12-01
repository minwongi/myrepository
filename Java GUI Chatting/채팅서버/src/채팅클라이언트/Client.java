package 채팅클라이언트;

import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.KeyEvent;
import java.awt.event.KeyListener;
import java.io.DataInputStream;
import java.io.DataOutputStream;
import java.io.IOException;
import java.io.InputStream;
import java.io.OutputStream;
import java.net.Socket;
import java.net.UnknownHostException;
import java.util.StringTokenizer;
import java.util.Vector;

import javax.swing.JButton;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JList;
import javax.swing.JOptionPane;
import javax.swing.JPanel;
import javax.swing.JTextArea;
import javax.swing.JTextField;
import javax.swing.border.EmptyBorder;

public class Client extends JFrame implements ActionListener, KeyListener {

	// 로그인 GUI 변수
	private JFrame Login_GUI = new JFrame();
	private JPanel Login_Pane;
	private JTextField ip_tf;
	private JTextField port_tf;
	private JTextField id_tf;
	private JButton login_btn = new JButton("접속");

	// 메인 GUI 변수
	private JPanel contentPane;
	private JTextField message_tf;
	private JButton notesend_btn = new JButton("쪽지보내기");
	private JButton joinroom_btn = new JButton("채팅방참여");
	private JButton createroom_btn = new JButton("방 만들기");
	private JButton send_btn = new JButton("전송");

	private JList User_list = new JList();
	private JList Room_list = new JList();
	private JTextArea Chat_area = new JTextArea();

	// 네트워크를 위한 자원 변수
	private Socket socket;
	private String ip = "";
	private int port;

	private String id = "";
	private InputStream is;
	private OutputStream os;
	private DataInputStream dis;
	private DataOutputStream dos;

	// 그외 변수들
	Vector user_list = new Vector();
	Vector room_list = new Vector();
	StringTokenizer st;

	private String My_Room; // 내가 있는 방이름

	Client() { // 생성자 메소드
		Login_init(); // 로그인 화면 구성 메소드
		Main_init(); // 메인창 화면 구성 메소드
		start();
	}

	private void Login_init() {
		Login_GUI.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		Login_GUI.setBounds(100, 100, 365, 374);
		Login_Pane = new JPanel();
		Login_Pane.setBorder(new EmptyBorder(5, 5, 5, 5));
		Login_GUI.setContentPane(Login_Pane);
		Login_Pane.setLayout(null);

		JLabel lblNewLabel = new JLabel("Server IP");
		lblNewLabel.setBounds(58, 62, 85, 30);
		Login_Pane.add(lblNewLabel);

		JLabel lblNewLabel_1 = new JLabel("Server Port");
		lblNewLabel_1.setBounds(58, 139, 85, 30);
		Login_Pane.add(lblNewLabel_1);

		JLabel lblNewLabel_2 = new JLabel("ID");
		lblNewLabel_2.setBounds(58, 211, 83, 30);
		Login_Pane.add(lblNewLabel_2);

		ip_tf = new JTextField();
		ip_tf.setBounds(187, 67, 96, 21);
		Login_Pane.add(ip_tf);
		ip_tf.setColumns(10);

		port_tf = new JTextField();
		port_tf.setBounds(187, 144, 96, 21);
		Login_Pane.add(port_tf);
		port_tf.setColumns(10);

		id_tf = new JTextField();
		id_tf.setBounds(187, 216, 96, 21);
		Login_Pane.add(id_tf);
		id_tf.setColumns(10);

		login_btn.setBounds(90, 282, 164, 23);
		Login_Pane.add(login_btn);

		Login_GUI.setVisible(true);
	}

	private void Main_init() {
		setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		setBounds(100, 100, 597, 421);
		contentPane = new JPanel();
		contentPane.setBorder(new EmptyBorder(5, 5, 5, 5));
		setContentPane(contentPane);
		contentPane.setLayout(null);

		JLabel lblNewLabel = new JLabel("전 체 접 속 자");
		lblNewLabel.setBounds(12, 10, 81, 15);
		contentPane.add(lblNewLabel);

		User_list.setBounds(12, 35, 127, 90);
		contentPane.add(User_list);
		User_list.setListData(user_list);

		notesend_btn.setBounds(12, 135, 127, 23);
		contentPane.add(notesend_btn);

		JLabel lblNewLabel_1 = new JLabel("채 팅 방 목 록");
		lblNewLabel_1.setBounds(12, 168, 81, 15);
		contentPane.add(lblNewLabel_1);

		Room_list.setBounds(12, 193, 127, 90);
		contentPane.add(Room_list);
		Room_list.setListData(room_list);

		joinroom_btn.setBounds(12, 293, 127, 23);
		contentPane.add(joinroom_btn);

		createroom_btn.setBounds(12, 326, 127, 23);
		contentPane.add(createroom_btn);

		Chat_area.setBounds(168, 31, 361, 285);
		contentPane.add(Chat_area);
		Chat_area.setEditable(false);

		message_tf = new JTextField();
		message_tf.setBounds(168, 327, 281, 22);
		contentPane.add(message_tf);
		message_tf.setColumns(10);
		message_tf.setEnabled(false);

		send_btn.setBounds(461, 326, 68, 23);
		contentPane.add(send_btn);
		send_btn.setEnabled(false);
		
		this.setVisible(false);
	}

	private void start() {
		login_btn.addActionListener(this);
		notesend_btn.addActionListener(this);
		joinroom_btn.addActionListener(this);
		createroom_btn.addActionListener(this);
		send_btn.addActionListener(this);
		message_tf.addKeyListener(this);
	}

	private void Network() {
		try {
			socket = new Socket(ip, port);
			if (socket != null) { // 정상적으로 소켓이 연결되었을 경우
				Connection();
			}
		} catch (UnknownHostException e) {
			e.printStackTrace();
			JOptionPane.showMessageDialog(null, "연결 실패", "알림", JOptionPane.ERROR_MESSAGE);
		}
		catch (IOException e) {
			e.printStackTrace();
			JOptionPane.showMessageDialog(null, "연결 실패", "알림", JOptionPane.ERROR_MESSAGE);
		}
	}

	private void Connection() { // 실제적인 메소드 연결부분
		try {
			is = socket.getInputStream();
			dis = new DataInputStream(is);
			os = socket.getOutputStream();
			dos = new DataOutputStream(os);
		} catch (IOException e) { // 에러처리 부분
			JOptionPane.showMessageDialog(null, "연결 실패", "알림", JOptionPane.ERROR_MESSAGE);
		} //Stream 설정 끝

		//메인 UI창 띄우기
		this.setVisible(true);
		
		//로그인 GUI 창 없애기
		this.Login_GUI.setVisible(false);
		
		// 처음 접속시에 ID 전송
		send_message(id);

		// User_list에 사용자 추가
		user_list.add(id);
//		User_list.setListData(user_list);

		Thread th = new Thread(new Runnable() {

			@Override
			public void run() {
				while (true) {
					try {
						String msg = dis.readUTF();// 메시지 수신
						System.out.println("서버로부터 수신된 메시지 : " + msg);
						inmessage(msg);
					} catch (IOException e) {
						e.printStackTrace();
						try {
						os.close();
						is.close();
						dos.close();
						dis.close();
						socket.close();
						JOptionPane.showMessageDialog(null, "서버와 접속 끊어짐", "알림", JOptionPane.ERROR_MESSAGE);
						}
						catch (IOException e1) {
							// TODO: handle exception
						}
						break;
						
					}
				}
			}
		});

		th.start();

//		send_message("클라이언트 접속합니다!\n");
//		
//		String msg = "";
//		try {
//			msg = dis.readUTF(); //서버로부터 메세지를 수신 (무한대기)
//			System.out.println("서버로부터 들어온 메시지 : " + msg);
//			send_message("~~~~~~~");
//		} catch (IOException e) {
//			// TODO Auto-generated catch block
//			e.printStackTrace();
//		}

	}

	private void inmessage(String str) { // 서버로부터 들어오는 모든 메시지
		st = new StringTokenizer(str, "/");

		String protocol = st.nextToken();
		String Message = st.nextToken();
		System.out.println("프로토콜 : " + protocol);
		System.out.println("내용 : " + Message);

		if (protocol.equals("NewUser")) { // 새로운 접속자
			user_list.add(Message);
//			 User_list.setListData(user_list);
//			 User_list.updateUI();
//			 AWT List add();
		} else if (protocol.equals("OldUser")) {
			user_list.add(Message);
//			 User_list.setListData(user_list);
		} else if (protocol.equals("Note")) {
//			 st = new StringTokenizer(Message, "@");
//			 String user = st.nextToken();
			String note = st.nextToken();
			System.out.println(Message + " 사용자로부터 온 쪽지 " + note);
			JOptionPane.showMessageDialog(null, note, Message + "님으로 부터 쪽지", JOptionPane.CLOSED_OPTION);
		} else if (protocol.equals("user_list_update")) {
			// User_list.updateUI();
			User_list.setListData(user_list);
		} else if (protocol.equals("CreateRoom")) { // 방을 만들었을때
			My_Room = Message;
			message_tf.setEnabled(true);
			send_btn.setEnabled(true);
			joinroom_btn.setEnabled(false);
			createroom_btn.setEnabled(false);
		} else if (protocol.equals("CreateRoomFail")) {
			JOptionPane.showMessageDialog(null, "방만들기 실패", "알림", JOptionPane.ERROR_MESSAGE);
		} else if (protocol.equals("New_Room")) {// 새로운 방을 만들었을때
			room_list.add(Message);
			Room_list.setListData(room_list);
		} else if (protocol.equals("Chatting")) {
			String msg = st.nextToken();
			Chat_area.append(Message + " : " + msg + "\n");
		} else if (protocol.equals("OldRoom")) {
			room_list.add(Message);
		} else if (protocol.equals("room_list_update")) {
			Room_list.setListData(room_list);
			// AWT List
		} else if (protocol.equals("JoinRoom")) {
			My_Room = Message;
			message_tf.setEnabled(true);
			send_btn.setEnabled(true);
			joinroom_btn.setEnabled(false);
			createroom_btn.setEnabled(false);
			JOptionPane.showMessageDialog(null, "채팅방에 입장했습니다.", "알림", JOptionPane.INFORMATION_MESSAGE);
		}
		else if (protocol.equals("User_out")) {
			user_list.remove(Message);
			
		}
	}

	private void send_message(String str) { // 서버에게 메시지를 보내는 부분
		try {
			dos.writeUTF(str);
		} catch (IOException e) {
			e.printStackTrace();
		}
	}

	public static void main(String[] args) {
		new Client();
	}
	

	@Override
	public void actionPerformed(ActionEvent e) {
		if (e.getSource() == login_btn) {
			// System.out.println("로그인 버튼 클릭");
			
			if(ip_tf.getText().length()==0) {
				ip_tf.setText("IP를 입력해주세요");
				ip_tf.requestFocus();
			}
			else if(port_tf.getText().length()==0) {
				port_tf.setText("PORT 번호를 입력해주세요");
				port_tf.requestFocus();
			}
			else if(id_tf.getText().length()==0) {
				id_tf.setText("ID를 입력해주세요");
				id_tf.requestFocus();
			}
			else {
				ip = ip_tf.getText().trim();
				port = Integer.parseInt(port_tf.getText().trim());
				id = id_tf.getText().trim();
				Network();
			}
			
		} else if (e.getSource() == notesend_btn) {
			// System.out.println("쪽지보내기 버튼 클릭");
			String user = (String) User_list.getSelectedValue();
			String note = JOptionPane.showInputDialog("보낼메시지");
			if (note != null) {
				send_message("Note/" + user + "/" + note);
				// ex Note/User2@나는 User1이야
			}
		System.out.println("받는 사람 : " + user + "|보낼 내용 : " + note);
		} else if (e.getSource() == joinroom_btn) {
			// System.out.println("방 참여 버튼 클릭");
			String JoinRoom = (String) Room_list.getSelectedValue();
			send_message("JoinRoom/" + JoinRoom);
		} else if (e.getSource() == createroom_btn) {
			// System.out.println("방 만들기 버튼 클릭");
			String roomname = JOptionPane.showInputDialog("방 이름");
			if (roomname != null) {
				send_message("CreateRoom/" + roomname);
			}
		} else if (e.getSource() == send_btn) {
			// System.out.println("전송 버튼 클릭");
			send_message("Chatting/" + My_Room + "/" + message_tf.getText().trim());
			message_tf.setText("");
			message_tf.requestFocus();
			// 채팅 + 방이름 + 내용
//			send_message("임시테스트입니다. \n");
		}
	}

	@Override
	public void keyTyped(KeyEvent e) {
		// TODO Auto-generated method stub
		
	}

	@Override
	public void keyPressed(KeyEvent e) {
		// TODO Auto-generated method stub
		System.out.println(e);
		if(e.getKeyCode() == 10) { // 엔터키 눌렀을때, java.awt.event.KeyEvent[KEY_PRESSED,keyCode=10,keyText=Enter,keyChar=Enter,keyLocation=KEY_LOCATION_STANDARD,rawCode=13,primaryLevelUnicode=13,scancode=28,extendedKeyCode=0xa] on javax.swing.JTextField[,168,327,281x22,layout=javax.swing.plaf.basic.BasicTextUI$UpdateHandler,alignmentX=0.0,alignmentY=0.0,border=javax.swing.plaf.BorderUIResource$CompoundBorderUIResource@7b46cf0f,flags=296,maximumSize=,minimumSize=,preferredSize=,caretColor=sun.swing.PrintColorUIResource[r=51,g=51,b=51],disabledTextColor=javax.swing.plaf.ColorUIResource[r=184,g=207,b=229],editable=true,margin=javax.swing.plaf.InsetsUIResource[top=0,left=0,bottom=0,right=0],selectedTextColor=sun.swing.PrintColorUIResource[r=51,g=51,b=51],selectionColor=javax.swing.plaf.ColorUIResource[r=184,g=207,b=229],columns=10,columnWidth=0,command=,horizontalAlignment=LEADING]
			send_message("Chatting/" + My_Room + "/" + message_tf.getText().trim());
			message_tf.setText("");
			message_tf.requestFocus();
		}
	}

	@Override
	public void keyReleased(KeyEvent e) {
		// TODO Auto-generated method stub
		
	}
}
