package com.mainpackage;

import android.content.Intent;
import android.os.Bundle;
import android.provider.ContactsContract;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.Toast;
import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.core.app.ActivityCompat;
import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentManager;

import com.example.userinformation.UserActivities;
import com.example.userinformation.UserActivitiesArray;
import com.google.android.material.bottomnavigation.BottomNavigationView;
import com.google.gson.Gson;
import com.google.gson.GsonBuilder;
import com.google.gson.reflect.TypeToken;
import com.loopj.android.http.AsyncHttpClient;
import com.loopj.android.http.RequestParams;
import com.loopj.android.http.TextHttpResponseHandler;
import com.squareup.picasso.Picasso;

import java.net.URL;
import java.text.SimpleDateFormat;
import java.util.ArrayList;

import coil.ImageLoader;
import coil.request.ImageRequest;
import cz.msebera.android.httpclient.Header;

public class ActivitysFragement extends Fragment {
    Gson gson = new Gson();
    ImageView imgImport,imgAddActivity;
    @Nullable
    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        return inflater.inflate(R.layout.fragement_activitys, container, false);
    }

    @Override
    public void onViewCreated(@NonNull View view, @Nullable Bundle savedInstanceState) {
        super.onViewCreated(view, savedInstanceState);
        getRequestUserActivities(25);
        //imgImport = (ImageView) getView().findViewById(R.id.fragementActivity_import_img);
        imgAddActivity = (ImageView) getView().findViewById(R.id.fragementActivity_add_img);
        imgAddActivity.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent i = new Intent(getActivity(), NewActivityActivity.class);
                startActivity(i);
            }
        });

    }
    private Gson getGson() {
        if (gson == null)
            gson = new GsonBuilder().setPrettyPrinting().create();
        return gson;
    }
    public void getRequestUserActivities(int userId){
        AsyncHttpClient client = new AsyncHttpClient();

        RequestParams params = new RequestParams();
        params.put("id",userId);
        client.get("https://projektptuj.ddns.net/api.php/baza/aktivnost/android", params, new TextHttpResponseHandler() {
            @Override
            public void onSuccess(int statusCode, Header[] headers, String res) {

                  //  UserActivitiesArray userActivitiesArray = new UserActivitiesArray("aleks");
                 //   SimpleDateFormat D = new SimpleDateFormat("hh:mm:ss");
                   // Gson gson = new GsonBuilder().setDateFormat(yyyy-mm-dd,hh:mm:ss).create();
                 //   userActivitiesArray = gson.fromJson(res, new TypeToken<ArrayList<UserActivities>>() {
                 //   }.getType());
                   // Toast.makeText(getActivity(), userActivitiesArray.toString(), Toast.LENGTH_LONG).show();


            }

            @Override
            public void onFailure(int statusCode, Header[] headers, String res, Throwable t) {
                // Toast.makeText(MainActivity.this,"neuspesna prijava",Toast.LENGTH_LONG).show();
            }
        });
    }
}
