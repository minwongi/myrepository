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

import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;

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
    private String profileUrl;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_list);

        listTextView = findViewById(R.id.listTextView);
        recyclerView = (RecyclerView) findViewById(R.id.rv);
        linearLayoutManager = new LinearLayoutManager(this);
        recyclerView.setLayoutManager(linearLayoutManager);
        arrayList = new ArrayList<>();
        Intent intent = getIntent();
        selectedDate = intent.getStringExtra("selectedDate");
        listTextView.setText(selectedDate);

        listAdapter = new ListAdapter(arrayList, this, this, new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if (v.getTag() != null) {
                    int t = (int) v.getTag();
                    String curSubject = arrayList.get(t).getTv_subject();
                    String curContent = arrayList.get(t).getTv_content();
                    String curAddress = arrayList.get(t).getTv_listaddress();
                    String curCategory = arrayList.get(t).getTv_listcategory();
                    String curUrl = profileUrl;

                    Intent intent = new Intent(getApplicationContext(), UpdateActivity.class);
                    intent.putExtra("subject", curSubject);
                    intent.putExtra("content", curContent);
                    intent.putExtra("address", curAddress);
                    intent.putExtra("category", curCategory);
                    //intent.putExtra("photourl", curUrl);
                    intent.putExtra("position", t);
                    startActivityForResult(intent, 1);

                }
            }
        }, new View.OnLongClickListener() {
            @Override
            public boolean onLongClick(View v) {
                if (v.getTag() != null) {
                    int t = (int) v.getTag();
                    databaseReference.child(selectedDate).child(arrayList.get(t).getKey()).removeValue();
                    arrayList.remove(t);
                    listAdapter.notifyDataSetChanged();
                }
                return true;
            }
        });
        recyclerView.setAdapter(listAdapter);

        database = FirebaseDatabase.getInstance();
        databaseReference = database.getReference("users").child("wongi").child("maps").child("1312323").child("manage");

        RefreshItem();

        //메인화면에서 추가버튼 눌렀을 때,
        Button btn_add = findViewById(R.id.btn_add);
        btn_add.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(ListActivity.this, PostActivity.class);
                startActivityForResult(intent, 1);
            }
        });
    }

    public String Ddate() {
        return selectedDate;
    }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, @Nullable Intent data) {
        super.onActivityResult(requestCode, resultCode, data);
        if (resultCode == 1) { // 삽입
            Date date = new Date();
            SimpleDateFormat sdf = new SimpleDateFormat("YYYYMMddHHmmss"); //현재시간 (database)에 넣을라고 한거야
            SimpleDateFormat sdf2 = new SimpleDateFormat("YYYYMMdd"); // 현재시간 (그냥 리사이클러뷰에 표시하기위함)

            String datestr = sdf.format(date); // 현재시간 (database)에 넣을라고 한거야
            String inputdatestr = sdf2.format(date); //  현재시간 (그냥 리사이클러뷰에 표시하기위함)

            String content = data.getExtras().getString("content");
            String subject = data.getExtras().getString("subject");
            String address = data.getExtras().getString("address");
            String category = data.getExtras().getString("category");
            String photoURL = data.getExtras().getString("photoURL");
            profileUrl = photoURL;
            ListData listData = new ListData(subject,content,inputdatestr,address,category,photoURL,datestr);
            databaseReference.child(selectedDate).child(datestr).setValue(listData);

            arrayList.add(listData);
            listAdapter.notifyDataSetChanged();
        }


        else if(resultCode == 2){ // 수정
            String content = data.getExtras().getString("content");
            String subject = data.getExtras().getString("subject");
            String address = data.getExtras().getString("address");
            String category = data.getExtras().getString("category");
            int position = data.getExtras().getInt("position");

            arrayList.get(position).setTv_content(content);
            arrayList.get(position).setTv_subject(subject);
            arrayList.get(position).setTv_listaddress(address);
            arrayList.get(position).setTv_listcategory(category);

            databaseReference.child(selectedDate).child(arrayList.get(position).getKey()).setValue(arrayList.get(position));
            listAdapter.notifyDataSetChanged();
        }
    }

    private void RefreshItem() {
        databaseReference.child(selectedDate).addListenerForSingleValueEvent(new ValueEventListener() {
            @Override
            public void onDataChange(@NonNull DataSnapshot dataSnapshot) {
                for (DataSnapshot snapshot : dataSnapshot.getChildren()) {
                    ListData listData = snapshot.getValue(ListData.class);
                    arrayList.add(listData);
                }
                listAdapter.notifyDataSetChanged();
            }

            @Override
            public void onCancelled(@NonNull DatabaseError error) {
                Log.e("ListActivity", String.valueOf(error.toException()));
            }
        });
    }
}