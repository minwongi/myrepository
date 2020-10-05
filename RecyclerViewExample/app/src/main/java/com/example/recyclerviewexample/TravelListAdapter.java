package com.example.recyclerviewexample;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.bumptech.glide.Glide;

import java.util.ArrayList;

public class TravelListAdapter extends RecyclerView.Adapter<TravelListAdapter.CustomViewHolder> {

    private ArrayList<TravelListData> arrayList;
    private Context context;
    View.OnClickListener clickListener;

    public TravelListAdapter(ArrayList<TravelListData> arrayList, Context context, View.OnClickListener clickListener) {
        this.clickListener = clickListener;
        this.arrayList = arrayList;
        this.context = context;
    }

    @NonNull
    @Override
    public CustomViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.item_travellist, parent, false);
        CustomViewHolder holder = new CustomViewHolder(view);
        return holder;
    }

    @Override
    public void onBindViewHolder(@NonNull CustomViewHolder holder, int position) {
        Glide.with(holder.itemView)
                .load(arrayList.get(position).getUrl())
                .into(holder.iv_photo);
        holder.tv_address.setText(arrayList.get(position).getAddress());
        holder.tv_category.setText(arrayList.get(position).getCategory());
        holder.v.setTag(position);
    }

    @Override
    public int getItemCount() {
        return (arrayList != null ? arrayList.size() : 0);
    }

    public class CustomViewHolder extends RecyclerView.ViewHolder {
        ImageView iv_photo;
        TextView tv_address;
        TextView tv_category;
        public View v;

        public CustomViewHolder(@NonNull View itemView) {
            super(itemView);
            this.iv_photo = itemView.findViewById(R.id.iv_photo);
            this.tv_address = itemView.findViewById(R.id.tv_address);
            this.tv_category = itemView.findViewById(R.id.tv_category);

            itemView.setClickable(true);
            itemView.setEnabled(true);
            itemView.setOnClickListener(clickListener);
            v=itemView;
        }
    }
}
