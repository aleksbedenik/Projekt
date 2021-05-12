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

public class RegisterAccount extends AppCompatActivity {
    EditText username,password,repeatPassword;
    TextView onUsername, onPassword, onRepeatPassword, hasAccount;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_register_account);
        username = (EditText) findViewById(R.id.registerActivity_username_editText);
        password = (EditText) findViewById(R.id.registerActivity_password_editText);
        repeatPassword = (EditText) findViewById(R.id.registerActivity_repeatPassword_editText);
        onRepeatPassword = (TextView) findViewById(R.id.registerActivity_onRepeatPassword_text);
        onPassword = (TextView) findViewById(R.id.registerActivity_login_onEditTextPassw);
        onUsername = (TextView) findViewById(R.id.registerActivity_login_onEditTextUser);
        hasAccount = (TextView) findViewById(R.id.registerActivity_hasAccount_text);
        hasAccount.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent i = new Intent(getBaseContext(), MainActivity.class);
                startActivity(i);
            }
        });
        editTextListeners();
        setNavigationBar();
    }
    public void setNavigationBar(){
        ActionBar actionBar = getSupportActionBar();
        actionBar.setHomeButtonEnabled(true);
        actionBar.setDisplayHomeAsUpEnabled(false);
        actionBar.setDisplayShowHomeEnabled(false);
        actionBar.setTitle("Registracija");
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
                    }
                    onPassword.setText("");
                }
            }
        });
        repeatPassword.setOnFocusChangeListener(new View.OnFocusChangeListener() {
            @Override
            public void onFocusChange(View v, boolean hasFocus) {
                if(hasFocus){
                    repeatPassword.setText("");
                    onRepeatPassword.setText("Ponovi geslo");
                }else{
                    if(TextUtils.isEmpty(repeatPassword.getText().toString())){
                        repeatPassword.setText("Ponovi geslo");
                    }
                    onRepeatPassword.setText("");
                }
            }
        });
    }
}