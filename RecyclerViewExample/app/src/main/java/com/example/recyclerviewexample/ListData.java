package com.example.recyclerviewexample;

public class ListData {

    private int iv_profile;
    private String tv_content;
    private String tv_time;

    public ListData(int iv_profile, String tv_content, String tv_time) {
        this.iv_profile = iv_profile;
        this.tv_content = tv_content;
        this.tv_time = tv_time;
    }

    public ListData() {
    }

    public int getIv_profile() {
        return iv_profile;
    }

    public void setIv_profile(int iv_profile) {
        this.iv_profile = iv_profile;
    }

    public String getTv_content() {
        return tv_content;
    }

    public void setTv_content(String tv_content) {
        this.tv_content = tv_content;
    }

    public String getTv_time() {
        return tv_time;
    }

    public void setTv_time(String tv_time) {
        this.tv_time = tv_time;
    }
}
