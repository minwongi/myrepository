package com.example.recyclerviewexample;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import com.firebase.ui.database.FirebaseRecyclerAdapter;
import com.firebase.ui.database.FirebaseRecyclerOptions;
import com.google.firebase.database.DataSnapshot;
import com.google.firebase.database.DatabaseError;
import com.google.firebase.database.DatabaseReference;
import com.google.firebase.database.FirebaseDatabase;
import com.google.firebase.database.ValueEventListener;

import java.util.ArrayList;

public class ListActivity extends AppCompatActivity {

    private ArrayList<ListData> arrayList;
    private ListAdapter listAdapter;
    private RecyclerView recyclerView;
    private LinearLayoutManager linearLayoutManager;
    private TextView listTextView;
    private FirebaseDatabase database;
    private DatabaseReference databaseReference;
    private String selectedDate;
    private PostActivity postActivity;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_list);



        listTextView = findViewById(R.id.listTextView);
        recyclerView = (RecyclerView)findViewById(R.id.rv);
        linearLayoutManager = new LinearLayoutManager(this);
        recyclerView.setLayoutManager(linearLayoutManager);
        arrayList = new ArrayList<>();
        Intent intent = getIntent(); // 선택된 날짜 보여주기
        selectedDate = intent.getStringExtra("selecteddate");
        listTextView.setText(selectedDate);

        listAdapter = new ListAdapter(arrayList, this, this);
        recyclerView.setAdapter(listAdapter);


        RefreshItem();
        //메인화면에서 추가버튼 눌렀을 때,
        Button btn_add = (Button)findViewById(R.id.btn_add);
        btn_add.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(ListActivity.this, PostActivity.class);
                intent.putExtra("selecteddate", selectedDate); // 다시 보내줌.
                startActivityForResult(intent, 1);
            }
        });

    }

    public String Ddate(){
        System.out.println("앙 기모링 " + selectedDate);
        return selectedDate;
    }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, @Nullable Intent data) {
        super.onActivityResult(requestCode, resultCode, data);
        if(resultCode == 0){
            //리사이클러뷰에 데이터 넣어주는 곳(DB연동)
            RefreshItem();
        }
    }

    private void RefreshItem(){
        database = FirebaseDatabase.getInstance();
        databaseReference = database.getReference("User").child("wongi");
        databaseReference.child(selectedDate).addListenerForSingleValueEvent(new ValueEventListener() {
            @Override
            public void onDataChange(@NonNull DataSnapshot dataSnapshot) {
                arrayList.clear();
                for (DataSnapshot snapshot : dataSnapshot.getChildren()) {
                    ListData listData = snapshot.getValue(ListData.class);
                    arrayList.add(listData);
                }
                listAdapter.notifyDataSetChanged();
                Toast.makeText(ListActivity.this, selectedDate, Toast.LENGTH_SHORT).show();
            }

            @Override
            public void onCancelled(@NonNull DatabaseError error) {
                Log.e("ListActivity",String.valueOf(error.toException()));
            }
        });
    }
}