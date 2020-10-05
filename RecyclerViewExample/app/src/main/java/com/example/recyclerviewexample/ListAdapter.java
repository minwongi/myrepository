package com.example.recyclerviewexample;

import android.content.Context;
import android.content.Intent;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.bumptech.glide.Glide;
import com.google.firebase.database.DatabaseReference;

import java.util.ArrayList;

public class ListAdapter extends RecyclerView.Adapter<ListAdapter.CustomViewHolder> {

    private ArrayList<ListData> arrayList;
    private Context context;
    private DatabaseReference databaseReference;
    private String selectedDate, datestr;
    private ListActivity listActivity;
    View.OnClickListener clickListener;
    View.OnLongClickListener longClickListener;
    boolean flag = false;

    public class CustomViewHolder extends RecyclerView.ViewHolder {

        protected ImageView iv_profile;
        protected TextView tv_subject;
        protected TextView tv_content;
        protected TextView tv_time;
        protected TextView tv_listaddress;
        protected TextView tv_listcategory;
        public View v;

        public CustomViewHolder(@NonNull View itemView) {
            super(itemView);

            this.iv_profile = (ImageView) itemView.findViewById(R.id.iv_profile);
            this.tv_subject = (TextView) itemView.findViewById(R.id.tv_subject);
            this.tv_content = (TextView) itemView.findViewById(R.id.tv_content);
            this.tv_time = (TextView) itemView.findViewById(R.id.tv_time);
            this.tv_listaddress = (TextView) itemView.findViewById(R.id.tv_listaddress);
            this.tv_listcategory = (TextView) itemView.findViewById(R.id.tv_listcategory);

            itemView.setClickable(true);
            itemView.setEnabled(true);
            itemView.setOnClickListener(clickListener);
            itemView.setOnLongClickListener(longClickListener);
            v = itemView;
        }
    }

    public ListAdapter(ArrayList<ListData> arrayList, Context context, ListActivity listActivity, View.OnClickListener clickListener,View.OnLongClickListener longClickListener) {
        this.clickListener = clickListener;
        this.arrayList = arrayList;
        this.longClickListener = longClickListener;
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
    public void onBindViewHolder(@NonNull final ListAdapter.CustomViewHolder holder, final int position) {
        Glide.with(holder.itemView)
                .load(arrayList.get(position).getIv_profile())
                .into(holder.iv_profile);
        holder.tv_subject.setText(arrayList.get(position).getTv_subject());
        holder.tv_content.setText(arrayList.get(position).getTv_content());
        holder.tv_listaddress.setText(arrayList.get(position).getTv_listaddress());
        holder.tv_listcategory.setText(arrayList.get(position).getTv_listcategory());
        holder.tv_time.setText(arrayList.get(position).getTv_time());

        holder.v.setTag(position);

    }

    @Override
    public int getItemCount() {
        return (arrayList != null ? arrayList.size() : 0);
    }

    public void remove(int position){
        try {
//            databaseReference = FirebaseDatabase.getInstance().getReference("User").child("wongi").child(selectedDate);
//            databaseReference.child(datestr).removeValue();
            arrayList.remove(position);  //지우기
            notifyItemRemoved(position); //새로고침
        } catch (IndexOutOfBoundsException ex){
            ex.printStackTrace();
        }
    }

    void addItem(ListData listData) {
        arrayList.add(listData);
    }
}
