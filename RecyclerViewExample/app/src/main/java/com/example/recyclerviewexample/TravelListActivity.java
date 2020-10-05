package com.example.recyclerviewexample;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Toast;

import com.google.firebase.database.DataSnapshot;
import com.google.firebase.database.DatabaseError;
import com.google.firebase.database.DatabaseReference;
import com.google.firebase.database.FirebaseDatabase;
import com.google.firebase.database.ValueEventListener;

import java.util.ArrayList;

public class TravelListActivity extends AppCompatActivity {

    private RecyclerView recyclerView;
    private RecyclerView.Adapter adapter;
    private RecyclerView.LayoutManager layoutManager;
    private ArrayList<TravelListData> arrayList;
    private FirebaseDatabase database;
    private DatabaseReference databaseReference;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_travel_list);

        recyclerView = findViewById(R.id.recyclerView);
        recyclerView.setHasFixedSize(true);
        layoutManager = new LinearLayoutManager(this);
        recyclerView.setLayoutManager(layoutManager);

        arrayList = new ArrayList<>();

        database = FirebaseDatabase.getInstance();

        databaseReference = database.getReference("users").child("wongi").child("maps").child("1312323").child("mylist");
        databaseReference.addListenerForSingleValueEvent(new ValueEventListener() {
            @Override
            public void onDataChange(@NonNull DataSnapshot dataSnapshot) {
                arrayList.clear();
                for (DataSnapshot snapshot : dataSnapshot.getChildren()) {
                    TravelListData travelListData = snapshot.getValue(TravelListData.class);
                    arrayList.add(travelListData);
                }
                adapter.notifyDataSetChanged();
            }

            @Override
            public void onCancelled(@NonNull DatabaseError databaseError) {
                Log.e("MainActivity", String.valueOf(databaseError.toException()));
            }
        });

        adapter = new TravelListAdapter(arrayList,null, new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if (v.getTag() != null) {
                    int t = (int) v.getTag();
                    String curAddress = arrayList.get(t).getAddress();
                    String curCategory = arrayList.get(t).getCategory();
                    String curUrl = arrayList.get(t).getUrl();

                    Intent intent = new Intent(getApplicationContext(), PostActivity.class);
                    intent.putExtra("address", curAddress);
                    intent.putExtra("category", curCategory);
                    intent.putExtra("url", curUrl);
                    intent.putExtra("position", t);

                    // 바로 이 시점에서 onActivityResult 수신 대기중인 곳으로 result 값을 쏴준다.. 다시 startActivity 를 해야할 필요 없고
                    // 현재 액티비티만 종료 해주면 된다.. 그래서 바로 밑에 finish(); 처리 추가 해줌.
                    setResult(5,intent);
                    finish();
                }
                System.out.println("getTag값 : ");
                System.out.println(v.getTag());
            }
        });
        recyclerView.setAdapter(adapter);

    }
}