package com.example.recyclerviewexample;

import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

import java.util.ArrayList;

public class ListActivity extends AppCompatActivity {

    private ArrayList<ListData> arrayList;
    private ListAdapter listAdapter;
    private RecyclerView recyclerView;
    private LinearLayoutManager linearLayoutManager;
    private TextView listTextView;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_list);

        listTextView = findViewById(R.id.listTextView);
        recyclerView = (RecyclerView)findViewById(R.id.rv);
        linearLayoutManager = new LinearLayoutManager(this);
        recyclerView.setLayoutManager(linearLayoutManager);
        arrayList = new ArrayList<>();
        listAdapter = new ListAdapter(arrayList);
        recyclerView.setAdapter(listAdapter);

        Intent intent = getIntent(); // 선택된 날짜 보여주기
        String str = intent.getStringExtra("str");
        listTextView.setText(str);

        //메인화면에서 추가버튼 눌렀을 때,
        Button btn_add = (Button)findViewById(R.id.btn_add);
        btn_add.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(ListActivity.this, PostActivity.class);
                startActivityForResult(intent, 1);
//                MainData mainData = new MainData(R.mipmap.ic_launcher, "민원기", "리사이클러뷰");
//                arrayList.add(mainData); // 추가하기
//                mainAdapter.notifyDataSetChanged(); // 새로고침
            }
        });
    }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, @Nullable Intent data) {
        super.onActivityResult(requestCode, resultCode, data);

        if(resultCode == 0){
            String strMain = data.getStringExtra("main");
            String strSub = data.getStringExtra("sub");
            ListData listData = new ListData(R.mipmap.ic_launcher, strMain, strSub);
            listAdapter.addItem(listData);
            listAdapter.notifyDataSetChanged();
            System.out.println("여기 들어오니?");
        }
    }
}