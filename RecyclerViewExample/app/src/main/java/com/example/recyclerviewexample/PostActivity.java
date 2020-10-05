package com.example.recyclerviewexample;

import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.TextView;
import android.widget.Toast;

import com.bumptech.glide.Glide;
import com.google.firebase.database.DatabaseReference;
import com.google.firebase.database.FirebaseDatabase;

import java.io.BufferedInputStream;
import java.io.IOException;
import java.io.InputStream;
import java.net.URL;
import java.net.URLConnection;
import java.text.SimpleDateFormat;
import java.util.Date;

public class PostActivity extends AppCompatActivity {


    EditText et_subject, et_content;
    Button btn_submit, btn_cancel, btn_listload;
    LinearLayout l_adress, l_category;
    TextView tv_addressload, tv_categoryload;
    ImageView iv_photoload;
    String photoURL;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_post);

        /* findViewById */
        l_adress = findViewById(R.id.l_adress);
        l_category = findViewById(R.id.l_category);

        iv_photoload = findViewById(R.id.iv_photoload);
        tv_addressload = findViewById(R.id.tv_addressload);
        tv_categoryload = findViewById(R.id.tv_categoryload);

        et_subject = findViewById(R.id.et_subject);
        et_content = findViewById(R.id.et_content);
        btn_submit = findViewById(R.id.btn_submit);
        btn_cancel = findViewById(R.id.btn_cancel);
        btn_listload = findViewById(R.id.btn_listload);

        Intent intent = getIntent();


        //리스트로드버튼 크릭시
        btn_listload.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(PostActivity.this, TravelListActivity.class);
                // 나중에 TravelListActivity 에서 수행하는 로직의 결과를 받아내야하기에 ForResult 로 수행
                startActivityForResult(intent, 5);
            }
        });


        //제출버튼
        btn_submit.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                String subject = et_subject.getText().toString();
                String content = et_content.getText().toString();
                String address = tv_addressload.getText().toString();
                String category = tv_categoryload.getText().toString();

                Intent intent = new Intent(getApplicationContext(), ListActivity.class);
                intent.putExtra("subject", subject);
                intent.putExtra("content", content);
                intent.putExtra("address", address);
                intent.putExtra("category", category);
                intent.putExtra("photoURL", photoURL);
                setResult(1, intent);
                finish();
            }
        });


        //취소버튼
        btn_cancel.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                finish();
            }
        });


    }

//    private Bitmap getImageBitmap(String url) {
//        Bitmap bm = null;
//        try {
//            URL aURL = new URL(url);
//            URLConnection conn = aURL.openConnection();
//            conn.connect();
//            InputStream is = conn.getInputStream();
//            BufferedInputStream bis = new BufferedInputStream(is);
//            bm = BitmapFactory.decodeStream(bis);
//            bis.close();
//            is.close();
//        } catch (IOException e) {
//
//        }
//        return bm;
//    }

    /**
     * setResult로 호출을 수행할 때 현재 액티비티가 살아있는 상황이면 onActivityResult가 실행된다.
     * @param requestCode startActivityForResult 수행할 때 같이 넣어줬던 requestCode 값이 되돌아 온다.
     * @param resultCode
     * @param data 다른 곳에서 setResult로 intent 값을 담아주게 될 때 이곳으로 딸려 온다.
     */
    @Override
    protected void onActivityResult(int requestCode, int resultCode, @Nullable Intent data) {
        super.onActivityResult(requestCode, resultCode, data);
        if(requestCode == 5) { // startActivityForResult 에 넣어줬던 requestCode 랑 같아야 함..
            if (data != null && data.getExtras() != null) {
                Log.e("PostActivity", "onActivityResult Enter");
//                Bitmap bm;
                String curAddress = data.getStringExtra("address");
                String curCategory = data.getStringExtra("category");
                String curUrl = data.getStringExtra("url");
                photoURL = curUrl;
                int position = data.getIntExtra("position", 0);

                l_adress.setVisibility(View.VISIBLE);
                l_category.setVisibility(View.VISIBLE);
                iv_photoload.setVisibility(View.VISIBLE);

//                bm = getImageBitmap(curUrl);

                tv_addressload.setText(curAddress);
                tv_categoryload.setText(curCategory);
                Glide.with(this).load(curUrl).into(iv_photoload);
            }
        }

    }
}