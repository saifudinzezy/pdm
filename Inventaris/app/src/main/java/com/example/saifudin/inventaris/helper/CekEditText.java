package com.example.saifudin.inventaris.helper;

import android.support.design.widget.TextInputEditText;
import android.text.TextUtils;

public class CekEditText {
    public static boolean editText(TextInputEditText input, String notif){
        boolean value = false;
        if (TextUtils.isEmpty(input.getText().toString())){
            input.setError(notif);
            value = true;
        }
        return value;
    }

    public static boolean editText(TextInputEditText input){
        boolean value = false;
        if (!TextUtils.isEmpty(input.getText().toString())){
            value = true;
        }
        return value;
    }
}