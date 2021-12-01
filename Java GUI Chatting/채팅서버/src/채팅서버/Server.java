package 채팅서버;

import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.io.DataInputStream;
import java.io.DataOutputStream;
import java.io.IOException;
import java.io.InputStream;
import java.io.OutputStream;
import java.net.ServerSocket;
import java.net.Socket;
import java.util.StringTokenizer;
import java.util.Vector;

import javax.swing.JButton;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JOptionPane;
import javax.swing.JPanel;
import javax.swing.JScrollPane;
import javax.swing.JTextArea;
import javax.swing.JTextField;
import javax.swing.border.EmptyBorder;

public class Server extends JFrame implements ActionListener {
	// 자동 import 단축키 : 컨트롤 쉬프트 O

	private JPanel contentPane;
	private JTextField port_tf;
	private JTextArea textArea = new JTextArea();
	private JButton start_btn = new JButton("서버 실행");
	private JButton stop_btn = new JButton("서버 중지");

	// 네트워크 자원
	private ServerSocket server_socket;
	private Socket socket;
	private int port;
	private Vector user_vc = new Vector<>();
	private Vector room_vc = new Vector<>();

	StringTokenizer st;

//	private InputStream is;
//	private OutputStream os;
//	private DataInputStream dis;
//	private DataOutputStream dos;

	Server() { // 생성자
		init(); // 화면 생성 메소드
		start(); // 리스너 설정 메소드
	}

	private void start() {
		start_btn.addActionListener(this);
		stop_btn.addActionListener(this);
	}

	private void init() { // 화면 구성
		setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		setBounds(100, 100, 384, 357);
		contentPane = new JPanel();
		contentPane.setBorder(new EmptyBorder(5, 5, 5, 5));
		setContentPane(contentPane);
		contentPane.setLayout(null);

		JScrollPane scrollPane = new JScrollPane();
		scrollPane.setBounds(12, 10, 306, 220);
		contentPane.add(scrollPane);

		scrollPane.setViewportView(textArea);
		textArea.setEditable(false);
		

		JLabel lblNewLabel = new JLabel("포트 번호");
		lblNewLabel.setBounds(12, 256, 60, 15);
		contentPane.add(lblNewLabel);

		port_tf = new JTextField();
		port_tf.setBounds(82, 253, 236, 21);
		contentPane.add(port_tf);
		port_tf.setColumns(10);

		start_btn.setBounds(12, 287, 149, 23);
		contentPane.add(start_btn);
		stop_btn.setEnabled(false);

		stop_btn.setBounds(174, 287, 144, 23);
		contentPane.add(stop_btn);

		this.setVisible(true); // true 화면 보임 false화면 안보임
	}

	private void Server_start() {
		try {
			server_socket = new ServerSocket(port); // 12345번 포트 사용
		} catch (IOException e) {
			e.printStackTrace();
			JOptionPane.showMessageDialog(null, "이미 사용중인 포트", "알림", JOptionPane.ERROR_MESSAGE);
		}

		if (server_socket != null) { // 정상적으로 포트가 열렸을 경우
			Connection();
		}
	}

	private void Connection() {
		// 1가지의 스래드에서는 1가지의 일만 처리할 수 있다.
		Thread th = new Thread(new Runnable() {
			@Override
			public void run() { // 스래드에서 처리할 일을 기재한다.
				while (true) {
					try {
						textArea.append("사용자 접속 대기중..\n");
						socket = server_socket.accept(); // 사용자 접속 대기
						textArea.append("사용자 접속 완료!!!\n");

						UserInfo user = new UserInfo(socket);
						user.start(); // 객체의 스레드 실행
//					try {
//						is = socket.getInputStream();
//						dis = new DataInputStream(is);
//						os = socket.getOutputStream();
//						dos = new DataOutputStream(os);
//					}
//					catch(IOException e) { //에러처리 부분
//							
//					}
//					
//					String msg = "";
//					msg = dis.readUTF(); //사용자(클라이언트)로부터 들어오는 메세지
//					textArea.append(msg);
//					dos.writeUTF("접속확인");
					} catch (IOException e) {
						e.printStackTrace();
						//JOptionPane.showMessageDialog(null, "accept 에러 발생 || 서버정지 클릭", "알림", JOptionPane.ERROR_MESSAGE);
						textArea.append("서버 중지\n");
						break;
					}
				}
			}
		});
		th.start();
	}

	public static void main(String[] args) {
		new Server();
	}

	@Override
	public void actionPerformed(ActionEvent e) {
		if (e.getSource() == start_btn) {
			System.out.println("서버 스타트 버튼 클릭");
			port = Integer.parseInt(port_tf.getText().trim());
			Server_start(); // 소켓 생성 및 사용자 접속 대기
			
			start_btn.setEnabled(false);
			port_tf.setEditable(false);
			stop_btn.setEnabled(true);
		} else if (e.getSource() == stop_btn) {
			System.out.println("서버 스탑 버튼 클릭");
			try {
				server_socket.close();
				user_vc.removeAllElements();
				room_vc.removeAllElements();
			} catch (IOException e1) {
				// TODO Auto-generated catch block
				e1.printStackTrace();
			}
			start_btn.setEnabled(true);
			port_tf.setEditable(true);
			stop_btn.setEnabled(false);
		}

	} // 액션 이벤트 끝

	class UserInfo extends Thread {
		private InputStream is;
		private OutputStream os;
		private DataInputStream dis;
		private DataOutputStream dos;

		private Socket user_socket;
		private String Nickname = "";
		private boolean RoomCh = true;

		UserInfo(Socket soc) { // 생성자 메소드
			this.user_socket = soc;
			UserNetwork();
		}

		public void UserNetwork() { // 네트워크 자원 설정
			try {
				is = user_socket.getInputStream();
				dis = new DataInputStream(is);
				os = user_socket.getOutputStream();
				dos = new DataOutputStream(os);
				Nickname = dis.readUTF(); // 사용자의 닉네임을 받는다.
				textArea.append(Nickname + " 사용자 접속!!\n");

				// 기존 사용자들에게 새로운 사용자 알림
				System.out.println("현재접속된 사용자수 : " + user_vc.size());

				BroadCast("NewUser/" + Nickname); // 기존 사용자에게 자신을 알림

				// 자신에게 기존 사용자를 받아오는 부분
				for (int i = 0; i < user_vc.size(); i++) {
					UserInfo u = (UserInfo) user_vc.elementAt(i);
					send_Message("OldUser/" + u.Nickname);
				}

				// 자신에게 기존 방 목록을 받아오는 부분
				for (int i = 0; i < room_vc.size(); i++) {
					RoomInfo r = (RoomInfo) room_vc.elementAt(i);
					send_Message("OldRoom/" + r.Room_name);
				}

				send_Message("room_list_update/ ");

				user_vc.add(this); // 사용자에게 알린 후 vector에 자신을 추가

//				BroadCast("UpdateUI_user/");
				BroadCast("user_list_update/ ");
			} catch (IOException e) {
				JOptionPane.showMessageDialog(null, "Straem 설정 에러 발생", "알림", JOptionPane.ERROR_MESSAGE);
			}

		}

		public void run() { // 스레드에서 처리할 내용
			while (true) {
				try {
					String msg = dis.readUTF();
					textArea.append(Nickname + " : 사용자로부터 들어온 메시지 : " + msg + "\n");
					InMessage(msg);
				} catch (IOException e) {
					e.printStackTrace();
					JOptionPane.showMessageDialog(null, "사용자 접속 끊어짐", "알림", JOptionPane.ERROR_MESSAGE);
					textArea.append(Nickname + " : 사용자 접속 끊어짐\n");
					try {
					dos.close();
					dis.close();
					user_socket.close();
					user_vc.remove(this);
					BroadCast("User_out/"+Nickname);
					BroadCast("user_list_update/ ");
					}
					catch (IOException e1) {
					}
					break;
				} // 메세지 수신
			}
		} // run 메소드 끝

		private void InMessage(String str) { // 클라이언트로부터 들어오는 메세지 처리
			st = new StringTokenizer(str, "/");

			String protocol = st.nextToken();
			String message = st.nextToken();
			System.out.println("프로토콜 : " + protocol);
			System.out.println("메세지 : " + message);

			if (protocol.equals("Note")) {
				// protocol=Note
				// message=user2@~~~
				// note=받는 내용

//				 st =new StringTokenizer(message,"@");
//				 String user = st.nextToken(); //다음 토큰으로 보내기
				String note = st.nextToken();

				System.out.println(message);
				System.out.println("받는 사람" + message);
				System.out.println("보낼 내용" + note);

				// 벡터에서 해당 사용자를 찾아서 전송
				for (int i = 0; i < user_vc.size(); i++) {
					UserInfo u = (UserInfo) user_vc.elementAt(i);
					if (u.Nickname.equals(message)) {
						u.send_Message("Note/" + Nickname + "/" + note);
						// Note/User1/~~~
					}
				}
			} // if문 끝
			else if (protocol.equals("CreateRoom")) {
				// 1. 현재 같은방이 존재하는지 확인한다.
				for (int i = 0; i < room_vc.size(); i++) {
					RoomInfo r = (RoomInfo) room_vc.elementAt(i);
					if (r.Room_name.equals(message)) { // 만들고자 하는 방이 이미 존재하면,
						send_Message("CreateRoomFail/ok");
						RoomCh = false;
						break;
					}
					if(r.Room_name.equals(message)) {
						send_Message("CreateRoomFail/ok");
						RoomCh = false;
						break;
					}
				} // for 끝
				if (RoomCh) { // 방을 만들수 있을때,
					RoomInfo new_room = new RoomInfo(message, this);
					room_vc.add(new_room); // 전체 방벡터에 방을 추가
					send_Message("CreateRoom/" + message);
					BroadCast("New_Room/" + message);
				}
				RoomCh = true;
			} // else if 문 끝
			else if (protocol.equals("Chatting")) {
				String msg = st.nextToken();
				for (int i = 0; i < room_vc.size(); i++) {
					RoomInfo r = (RoomInfo) room_vc.elementAt(i);
					if (r.Room_name.equals(message)) { // 해당 방을 찾았을 때
//						for (int j = 0; j < r.Room_user_vc.size(); j++) {
//							UserInfo u = (UserInfo)r.Room_user_vc.elementAt(j);
//							u.send_Message("채팅내용");
//						}
						r.BroadCast_Room("Chatting/" + Nickname + "/" + msg);
					}
				}
			} //else if 문 끝
			else if (protocol.equals("JoinRoom")) {
				for (int i = 0; i < room_vc.size(); i++) {
					RoomInfo r = (RoomInfo) room_vc.elementAt(i);
					if (r.Room_name.equals(message)) {
						//새로운 사용자를 알린다.
						r.BroadCast_Room("Chatting/알림/*****" + Nickname + "님이 입장하셨습니다. *****");
						
						// 사용자 추가
						r.Add_User(this);
						send_Message("JoinRoom/" + message);
					}
				}
			}
		}

		private void BroadCast(String str) { // 전체 사용자에게 메시지 보내는 부분
			for (int i = 0; i < user_vc.size(); i++) { // 현재 접속된 접속자에게 새로운 사용자 알림
				UserInfo u = (UserInfo) user_vc.elementAt(i);
				u.send_Message(str);
			}
		}

		private void send_Message(String str) {
			try {
				dos.writeUTF(str);
			} catch (IOException e) {
				e.printStackTrace();
			}
		}

	} // UserInfo Class 끝

	class RoomInfo {
		private String Room_name;
		private Vector Room_user_vc = new Vector();

		RoomInfo(String str, UserInfo u) {
			this.Room_name = str;
			this.Room_user_vc.add(u);
		}

		public void BroadCast_Room(String str) { // 현재 방의 모든 사람에게 알린다
			for (int i = 0; i < Room_user_vc.size(); i++) {
				UserInfo u = (UserInfo) Room_user_vc.elementAt(i);
				u.send_Message(str);
			}
		}

		private void Add_User(UserInfo u) {
			this.Room_user_vc.add(u);
		}
	}
}
