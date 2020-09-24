package com.example.recyclerviewexample;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.google.firebase.database.DatabaseReference;
import com.google.firebase.database.FirebaseDatabase;

import java.util.ArrayList;

public class ListAdapter extends RecyclerView.Adapter<ListAdapter.CustomViewHolder> {

    private ArrayList<ListData> arrayList;
    private Context context;
    private DatabaseReference databaseReference;
    private String selectedDate, datestr;
    private ListActivity listActivity;
    boolean flag = false;

    public ListAdapter(ArrayList<ListData> arrayList, Context context, ListActivity listActivity) {
        this.arrayList = arrayList;
        this.context = context;
        this.listActivity = listActivity;
        selectedDate = listActivity.Ddate();
    }

    @NonNull
    @Override
    public ListAdapter.CustomViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.item_list, parent, false);
        CustomViewHolder holder = new CustomViewHolder(view);
        return holder;
    }

    @Override
    public void onBindViewHolder(@NonNull final ListAdapter.CustomViewHolder holder, int position) {
        holder.iv_profile.setImageResource(arrayList.get(position).getIv_profile());
        holder.tv_content.setText(arrayList.get(position).getTv_content());
        holder.tv_time.setText(arrayList.get(position).getTv_time());

        holder.itemView.setTag(position);

       // final String key=getRef(position).getKey();
        holder.itemView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                String curName = holder.tv_content.getText().toString();

                Toast.makeText(view.getContext(), curName, Toast.LENGTH_SHORT).show();
            }
        });


        // 리스트 삭제
        holder.itemView.setOnLongClickListener(new View.OnLongClickListener() {
            @Override
            public boolean onLongClick(View view) {
                remove(holder.getAdapterPosition()); // 파라미터 : 현재 어댑터 위치를 반환해줌
                flag = true;
                return true;
            }
        });
    }

    @Override
    public int getItemCount() {
        return (arrayList != null ? arrayList.size() : 0);
    }

    public void remove(int position){
        try {
            System.out.println(selectedDate);
            System.out.println(datestr);
            databaseReference = FirebaseDatabase.getInstance().getReference("User").child("wongi").child(selectedDate);
            databaseReference.child(datestr).removeValue();
            arrayList.remove(position);  //지우기
            notifyItemRemoved(position); //새로고침
        } catch (IndexOutOfBoundsException ex){
            ex.printStackTrace();
        }
    }

    void addItem(ListData listData) {
        arrayList.add(listData);
    }

    public class CustomViewHolder extends RecyclerView.ViewHolder {

        protected ImageView iv_profile;
        protected TextView tv_content;
        protected TextView tv_time;

        public CustomViewHolder(@NonNull View itemView) {
            super(itemView);
            this.iv_profile = (ImageView) itemView.findViewById(R.id.iv_profile);
            this.tv_content = (TextView) itemView.findViewById(R.id.tv_content);
            this.tv_time = (TextView) itemView.findViewById(R.id.tv_time);
        }
    }
}
