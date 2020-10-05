package com.example.recyclerviewexample;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;

import com.google.firebase.database.DatabaseReference;

public class UpdateActivity extends AppCompatActivity {

    EditText et_subject, et_content, et_addressload, et_categoryload;
    Button btn_update;
    private int position;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_update);

        et_subject=findViewById(R.id.et_subject);
        et_content=findViewById(R.id.et_content);
        et_addressload=findViewById(R.id.et_addressload);
        et_categoryload=findViewById(R.id.et_categoryload);
        btn_update=findViewById(R.id.btn_update);


        Intent intent = getIntent();
        String content = intent.getExtras().getString("content");
        String subject = intent.getExtras().getString("subject");
        String address = intent.getExtras().getString("address");
        String category = intent.getExtras().getString("category");
        //String photourl = intent.getExtras().getString("photourl");
        position = intent.getExtras().getInt("position");


        et_subject.setText(subject);
        et_content.setText(content);
        et_addressload.setText(address);
        et_categoryload.setText(category);

        btn_update.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(UpdateActivity.this,ListActivity.class);
                String subject = et_subject.getText().toString();
                String content = et_content.getText().toString();
                String address = et_addressload.getText().toString();
                String category = et_categoryload.getText().toString();

                intent.putExtra("subject", subject );
                intent.putExtra("content", content );
                intent.putExtra("address",  address);
                intent.putExtra("category", category );
                intent.putExtra("position", position);
                setResult(2, intent); //0일때 확인
                finish(); // 현재 액티비티 종료
            }
        });
    }
}