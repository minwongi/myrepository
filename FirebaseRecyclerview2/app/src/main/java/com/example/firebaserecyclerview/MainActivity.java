package com.example.firebaserecyclerview;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import com.google.android.gms.tasks.OnFailureListener;
import com.google.android.gms.tasks.OnSuccessListener;
import com.google.firebase.database.DataSnapshot;
import com.google.firebase.database.DatabaseError;
import com.google.firebase.database.DatabaseReference;
import com.google.firebase.database.FirebaseDatabase;
import com.google.firebase.database.ValueEventListener;

import java.util.HashMap;
import java.util.Map;

public class MainActivity extends AppCompatActivity {

    private EditText inputID, inputName;
    private Button btnSave;

    DatabaseReference ref;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        inputID = findViewById(R.id.inputID);
        inputName = findViewById(R.id.inputName);
        btnSave = findViewById(R.id.btnSave);

        ref = FirebaseDatabase.getInstance().getReference().child("User");

        btnSave.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                int ID = Integer.parseInt(inputID.getText().toString());
                String name = inputName.getText().toString();

                String key = ref.push().getKey();
                ref.child(key).child("ID").setValue(ID);
                ref.child(key).child("Name").setValue(name);
            }
        });
    }
}