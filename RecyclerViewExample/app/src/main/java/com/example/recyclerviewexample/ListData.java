package com.example.recyclerviewexample;

public class ListData {

    private String tv_subject;
    private String tv_content;
    private String tv_time;
    private String tv_listaddress;
    private String tv_listcategory;
    private String iv_profile; //프로필 주소가 들어감. 데이터베이스에
    private String key;

    public ListData(String tv_subject, String tv_content, String tv_time, String tv_listaddress, String tv_listcategory, String iv_profile, String key) {
        this.tv_subject = tv_subject;
        this.tv_content = tv_content;
        this.tv_time = tv_time;
        this.tv_listaddress = tv_listaddress;
        this.tv_listcategory = tv_listcategory;
        this.iv_profile = iv_profile;
        this.key = key;
    }

    public String getTv_listaddress() {
        return tv_listaddress;
    }

    public void setTv_listaddress(String tv_listaddress) {
        this.tv_listaddress = tv_listaddress;
    }

    public String getTv_listcategory() {
        return tv_listcategory;
    }

    public void setTv_listcategory(String tv_listcategory) {
        this.tv_listcategory = tv_listcategory;
    }

    public String getTv_subject() {
        return tv_subject;
    }

    public void setTv_subject(String tv_subject) {
        this.tv_subject = tv_subject;
    }

    public String getKey() {
        return key;
    }

    public void setKey(String key) {
        this.key = key;
    }


    public ListData() {
    }

    public String getIv_profile() {
        return iv_profile;
    }

    public void setIv_profile(String iv_profile) {
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
