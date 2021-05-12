package com.mainpackage;

import androidx.appcompat.app.ActionBar;
import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.text.TextUtils;
import android.util.Log;
import android.view.View;
import android.widget.EditText;
import android.widget.TextView;

public class MainActivity extends AppCompatActivity {
    EditText username,password;
    TextView onUsername, onPassword;
    TextView textForgotPassword,textRegisterAccount;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        username = (EditText) findViewById(R.id.registerActivity_username_editText);
        password = (EditText) findViewById(R.id.registerActivity_password_editText);
        onPassword = (TextView) findViewById(R.id.registerActivity_login_onEditTextPassw);
        onUsername = (TextView) findViewById(R.id.registerActivity_login_onEditTextUser);
        textRegisterAccount = (TextView) findViewById(R.id.registerActivity_hasAccount_text);
        textRegisterAccount.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent i = new Intent(getBaseContext(), RegisterAccount.class);
                startActivity(i);
            }
        });
        setNavigationBar();
        // checks for focus on EditText's
        editTextListeners();

    }
    public void setNavigationBar(){
        ActionBar actionBar = getSupportActionBar();
        actionBar.setHomeButtonEnabled(true);
        actionBar.setDisplayHomeAsUpEnabled(false);
        actionBar.setDisplayShowHomeEnabled(false);
        actionBar.setTitle("Prijava");
        actionBar.show();
    }
    public void editTextListeners(){
        username.setOnFocusChangeListener(new View.OnFocusChangeListener() {
            @Override
            public void onFocusChange(View v, boolean hasFocus) {
                if(hasFocus){
                    username.setText("");
                    onUsername.setText("Uporabniško ime");
                }else{
                    if(TextUtils.isEmpty(username.getText().toString())){
                        username.setText("Uporabniško ime");
                    }
                    onUsername.setText("");
                }
            }
        });
        password.setOnFocusChangeListener(new View.OnFocusChangeListener() {
            @Override
            public void onFocusChange(View v, boolean hasFocus) {
                if(hasFocus){
                    password.setText("");
                    onPassword.setText("Geslo");
                }else{
                    if(TextUtils.isEmpty(password.getText().toString())){
                        password.setText("Geslo");
                        Log.i("Main","Dela");
                    }
                    onPassword.setText("");
                }
            }
        });
    }


    public void buttonTest(View view) {
        Intent i = new Intent(getBaseContext(), MainDashboard.class);
        startActivity(i);
    }
}