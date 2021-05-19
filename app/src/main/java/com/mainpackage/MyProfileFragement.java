package com.mainpackage;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.preference.PreferenceManager;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.fragment.app.Fragment;

import com.example.userinformation.UserInfo;
import com.example.userinformation.UserInfoArray;
import com.google.gson.Gson;
import com.google.gson.reflect.TypeToken;
import com.loopj.android.http.AsyncHttpClient;
import com.loopj.android.http.RequestParams;
import com.loopj.android.http.TextHttpResponseHandler;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

import cz.msebera.android.httpclient.Header;

public class MyProfileFragement extends Fragment {
    Button logout;
    SharedPreferences sp;
    public String getRes;
    @Nullable
    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        return inflater.inflate(R.layout.fragement_my_profile, container, false);

    }
    @Override
    public void onViewCreated(@NonNull View view, @Nullable Bundle savedInstanceState) {
        super.onViewCreated(view, savedInstanceState);
        //imgImport = (ImageView) getView().findViewById(R.id.fragementActivity_import_img);
        getRequestUserActivities(29);


        logout = (Button) getView().findViewById(R.id.Myprofile_Logout_Button);
        logout.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                sp = getActivity().getSharedPreferences("com.mainpackage_preferences", Context.MODE_PRIVATE);
                sp.edit().remove("USER ID").commit();
               // String id = sp.getString("USER ID", "error");
               // Log.i("SharedPrefTest", id);
                Intent i = new Intent(getActivity(), MainActivity.class);
                getActivity().finish();
                startActivity(i);
            }
        });

    }
    public void getRequestUserActivities(int userId){
        AsyncHttpClient client = new AsyncHttpClient();

        RequestParams params = new RequestParams();
        params.put("id",userId);
        client.get("https://projektptuj.ddns.net/api.php/baza/user/android", params, new TextHttpResponseHandler() {
            @Override
            public void onSuccess(int statusCode, Header[] headers, String res) {

                try {
                    JSONArray json = new JSONArray(res);
                    String text = json.get(0).toString();
                   // for(int i = 0 ; i <json.length();i++){
                        JSONObject jsonobject = json.getJSONObject(0);
                          String ime = jsonobject.get("ime").toString();
                          String priimek = jsonobject.get("priimek").toString();
                          String email = jsonobject.get("email").toString();
                          String telefon = jsonobject.get("telefon").toString();
                          String teza = jsonobject.get("teza").toString();
                          String visina= jsonobject.get("visina").toString();
                          String spol = jsonobject.get("spol").toString();
                        Log.i("Jsonparams", ime);
                        Log.i("Jsonparams", priimek);
                        Log.i("Jsonparams", email);
                        Log.i("Jsonparams", telefon);
                        Log.i("Jsonparams", teza);
                        Log.i("Jsonparams", visina);
                        Log.i("Jsonparams", spol);
                   // }
                  //  String priimek = json.get("priimek").toString();
                  //  String email = json.get("email").toString();
                  //  String telefon = json.get("telefon").toString();
                  //  String teza = json.get("teza").toString();
                 //   String visina= json.get("visina").toString();
                  //  String spol = json.get("spol").toString();
                    Log.i("test", "kys "+ime);
                    Toast.makeText(getActivity(), ime, Toast.LENGTH_LONG).show();


                } catch (JSONException e) {
                    e.printStackTrace();
                }




            }

            @Override
            public void onFailure(int statusCode, Header[] headers, String res, Throwable t) {
                // Toast.makeText(MainActivity.this,"neuspesna prijava",Toast.LENGTH_LONG).show();
            }
        });
    }
}
