package com.example.recyclerviewexample;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.EditText;

import java.text.SimpleDateFormat;
import java.util.Date;

public class PostActivity extends AppCompatActivity {

    EditText et_subject;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_post);

        et_subject = findViewById(R.id.et_subject);

        findViewById(R.id.btn_submit).setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                String subject = et_subject.getText().toString();

                if(subject.length()>0) {
                    Date date = new Date();
                    SimpleDateFormat sdf = new SimpleDateFormat("YYYY-MM-dd-EE");
                    String datestr = sdf.format(date);

                    Intent intent = new Intent();
                    intent.putExtra("main", subject); //제목
                    intent.putExtra("sub", datestr); //날짜
                    setResult(0, intent); //0일때 확인
                    finish(); // 현재 액티비티 종료
                }
            }
        });

        findViewById(R.id.btn_cancel).setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                System.out.println("취소눌림");
                Intent intent = new Intent();
                setResult(1, intent); //1일때 취소소
                finish();
            }
        });
    }
}