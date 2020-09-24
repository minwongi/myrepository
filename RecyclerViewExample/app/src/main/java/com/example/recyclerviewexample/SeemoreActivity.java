package com.example.recyclerviewexample;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.widget.TextView;

import com.google.firebase.database.DatabaseReference;
import com.google.firebase.database.FirebaseDatabase;

public class SeemoreActivity extends AppCompatActivity {

    TextView textViewID, textViewName;
    DatabaseReference databaseReference;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_seemore);

        textViewID=findViewById(R.id.textViewID);
        textViewName=findViewById(R.id.textViewName);
        databaseReference = FirebaseDatabase.getInstance().getReference().child("User");

       // String key = getIntent().getStringExtra("key");
    }
}