import java.awt.BorderLayout;
import java.awt.EventQueue;

import javax.swing.JFrame;
import javax.swing.JPanel;
import javax.swing.border.EmptyBorder;
import javax.swing.JLabel;
import javax.swing.JList;
import javax.swing.JButton;
import javax.swing.JTextArea;
import javax.swing.JTextField;

public class Main_Client extends JFrame {

	private JPanel contentPane;
	private JTextField textField;

	/**
	 * Launch the application.
	 */
	public static void main(String[] args) {
		EventQueue.invokeLater(new Runnable() {
			public void run() {
				try {
					Main_Client frame = new Main_Client();
					frame.setVisible(true);
				} catch (Exception e) {
					e.printStackTrace();
				}
			}
		});
	}

	/**
	 * Create the frame.
	 */
	public Main_Client() {
		setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		setBounds(100, 100, 597, 421);
		contentPane = new JPanel();
		contentPane.setBorder(new EmptyBorder(5, 5, 5, 5));
		setContentPane(contentPane);
		contentPane.setLayout(null);
		
		JLabel lblNewLabel = new JLabel("\uC804 \uCCB4 \uC811 \uC18D \uC790");
		lblNewLabel.setBounds(12, 10, 81, 15);
		contentPane.add(lblNewLabel);
		
		JList list = new JList();
		list.setBounds(12, 35, 127, 90);
		contentPane.add(list);
		
		JButton btnNewButton = new JButton("\uCABD\uC9C0\uBCF4\uB0B4\uAE30");
		btnNewButton.setBounds(12, 135, 127, 23);
		contentPane.add(btnNewButton);
		
		JLabel lblNewLabel_1 = new JLabel("\uCC44 \uD305 \uBC29 \uBAA9 \uB85D");
		lblNewLabel_1.setBounds(12, 168, 81, 15);
		contentPane.add(lblNewLabel_1);
		
		JList list_1 = new JList();
		list_1.setBounds(12, 193, 127, 90);
		contentPane.add(list_1);
		
		JButton btnNewButton_1 = new JButton("\uCC44\uD305\uBC29\uCC38\uC5EC");
		btnNewButton_1.setBounds(12, 293, 127, 23);
		contentPane.add(btnNewButton_1);
		
		JButton btnNewButton_2 = new JButton("\uBC29 \uB9CC\uB4E4\uAE30");
		btnNewButton_2.setBounds(12, 326, 127, 23);
		contentPane.add(btnNewButton_2);
		
		JTextArea textArea = new JTextArea();
		textArea.setBounds(168, 31, 361, 285);
		contentPane.add(textArea);
		
		textField = new JTextField();
		textField.setBounds(168, 327, 281, 22);
		contentPane.add(textField);
		textField.setColumns(10);
		
		JButton btnNewButton_3 = new JButton("\uC804\uC1A1");
		btnNewButton_3.setBounds(461, 326, 68, 23);
		contentPane.add(btnNewButton_3);
	}
}
