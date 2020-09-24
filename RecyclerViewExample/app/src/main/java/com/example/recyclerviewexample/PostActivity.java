package com.example.recyclerviewexample;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.EditText;

import com.google.firebase.database.DatabaseReference;
import com.google.firebase.database.FirebaseDatabase;

import java.text.SimpleDateFormat;
import java.util.Date;

public class PostActivity extends AppCompatActivity {

    EditText et_subject;
    DatabaseReference databaseReference;
    private String datestr;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_post);

        et_subject = findViewById(R.id.et_subject);

        databaseReference = FirebaseDatabase.getInstance().getReference("User").child("wongi");

        Intent intent = getIntent(); // 선택된 날짜 보여주기
        final String selectedDate = intent.getStringExtra("selecteddate");

        findViewById(R.id.btn_submit).setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                String subject = et_subject.getText().toString();
                if(subject.length()>0) {
                    Date date = new Date();
                    SimpleDateFormat sdf = new SimpleDateFormat("YYYYMMddHHmmss"); //현재시간 (database)에 넣을라고 한거야
                    SimpleDateFormat sdf2 = new SimpleDateFormat("YYYYMMdd"); // 현재시간 (그냥 리사이클러뷰에 표시하기위함)
                    datestr = sdf.format(date); // 현재시간 (database)에 넣을라고 한거야
                    String inputdatestr = sdf2.format(date); //  현재시간 (그냥 리사이클러뷰에 표시하기위함)

                    ListData listData = new ListData(R.mipmap.ic_launcher,subject,inputdatestr);

                    databaseReference.child(selectedDate).child(datestr).setValue(listData);

                    Intent intent = new Intent();
                    intent.putExtra("selectedtime", selectedDate); //달력에서 선택한 시간
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
                setResult(1, intent); //1일때 취소
                finish();
            }
        });
    }

    public String Edate(){
        return datestr;
    }
}