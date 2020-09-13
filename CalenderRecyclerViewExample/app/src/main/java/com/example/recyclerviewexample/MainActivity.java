package com.example.recyclerviewexample;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.CalendarView;
import android.widget.TextView;

public class MainActivity extends AppCompatActivity {

    public CalendarView calendarView;
    public TextView diaryTextView;
    public Button intentButton;
    public String str;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        calendarView = findViewById(R.id.calendarView);
        diaryTextView = findViewById(R.id.diaryTextView);
        intentButton = findViewById(R.id.intentButton);

        calendarView.setOnDateChangeListener(new CalendarView.OnDateChangeListener() {
            @Override
            public void onSelectedDayChange(@NonNull CalendarView view, int year, int month, int dayOfMonth) {
                diaryTextView.setVisibility(View.VISIBLE);
                diaryTextView.setText(String.format("%d / %d / %d",year,month+1,dayOfMonth));
            }
        });

        intentButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                str = diaryTextView.getText().toString();
                Intent intent = new Intent(MainActivity.this, ListActivity.class);
                intent.putExtra("str", str);
                startActivity(intent); //액티비티 이동
            }
        });
    }
}