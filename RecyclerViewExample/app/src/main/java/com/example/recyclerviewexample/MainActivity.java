package com.example.recyclerviewexample;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.CalendarView;
import android.widget.TextView;

import com.google.firebase.database.DatabaseReference;
import com.google.firebase.database.FirebaseDatabase;

public class MainActivity extends AppCompatActivity {

    public CalendarView calendarView;
    public TextView diaryTextView;
    public String selecteddate;
    private DatabaseReference ref;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        calendarView = findViewById(R.id.calendarView);
        diaryTextView = findViewById(R.id.diaryTextView);

        calendarView.setOnDateChangeListener(new CalendarView.OnDateChangeListener() {
            @Override
            public void onSelectedDayChange(@NonNull CalendarView view, int year, int month, int dayOfMonth) {
                diaryTextView.setVisibility(View.VISIBLE);
                String smonth,sday;
                String syear = Integer.toString(year);
                if(month / 10 == 0){
                    smonth = "0";
                    smonth += Integer.toString(month+1);
                } else {
                    smonth = Integer.toString(month+1);
                }
                if(dayOfMonth / 10 == 0) {
                    sday = "0";
                    sday += Integer.toString(dayOfMonth);
                } else {
                    sday = Integer.toString(dayOfMonth);
                }
                diaryTextView.setText(syear+smonth+sday);
//                diaryTextView.setText(String.format("%d - %d - %d",year,month+1,dayOfMonth));
                selecteddate = diaryTextView.getText().toString();
                Intent intent = new Intent(MainActivity.this, ListActivity.class);
                intent.putExtra("selecteddate", selecteddate);
                startActivity(intent); //List액티비티 이동
            }
        });


    }
}