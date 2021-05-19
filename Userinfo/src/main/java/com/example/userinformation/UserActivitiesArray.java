package com.example.userinformation;

import java.util.ArrayList;

import javax.jws.soap.SOAPBinding;

public class UserActivitiesArray {
    private String name;
    private ArrayList<UserActivities> arrayList;

    public UserActivitiesArray(String name) {
        this.name = name;
        this.arrayList = new ArrayList<UserActivities>();
    }

    public void setName(String name) {
        this.name = name;
    }

    public void setArrayList(ArrayList<UserActivities> arrayList) {
        this.arrayList = arrayList;
    }

    public String getName() {
        return name;
    }

    public ArrayList<UserActivities> getArrayList() {
        return arrayList;
    }
}
