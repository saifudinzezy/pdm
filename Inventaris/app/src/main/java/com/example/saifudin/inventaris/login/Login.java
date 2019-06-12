package com.example.saifudin.inventaris.login;

import android.content.Intent;
import android.os.Bundle;
import android.support.design.widget.TextInputEditText;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.AppCompatButton;
import android.text.TextUtils;
import android.view.View;
import android.widget.Toast;

import com.example.saifudin.inventaris.R;
import com.example.saifudin.inventaris.menus.MainActivity;
import com.example.saifudin.inventaris.model.ResponseLogin;
import com.example.saifudin.inventaris.model.UserItem;
import com.example.saifudin.inventaris.network.ApiService;
import com.example.saifudin.inventaris.network.RetroClient;
import com.example.saifudin.inventaris.session.Session;
import com.wang.avi.AVLoadingIndicatorView;

import java.util.List;

import butterknife.BindView;
import butterknife.ButterKnife;
import butterknife.OnClick;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

import static com.example.saifudin.inventaris.constan.Koneksi.SUCCESS;
import static com.example.saifudin.inventaris.constan.Logins.*;
import static com.example.saifudin.inventaris.session.Session.SP_SUDAH_LOGIN;
import static com.example.saifudin.inventaris.session.Session.SP_SUDAH_LOGIN2;

public class Login extends AppCompatActivity {

    @BindView(R.id.input_email)
    TextInputEditText inputEmail;
    @BindView(R.id.input_password)
    TextInputEditText inputPassword;
    @BindView(R.id.btn_login)
    AppCompatButton btnLogin;
    @BindView(R.id.loader)
    AVLoadingIndicatorView loader;
    @BindView(R.id.btn_create_account)
    AppCompatButton btnCreateAccount;
    Session sharedLogin;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);
        ButterKnife.bind(this);

        sharedLogin = new Session(this);

        //cek apakah user sudah login
        if (sharedLogin.getSPSudahLogin()) {
            if (sharedLogin.getSPSudahLogin2()) {
                //cek login kedua
                startActivity(new Intent(Login.this, MainActivity.class)
                        .addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP | Intent.FLAG_ACTIVITY_NEW_TASK));
                finish();
            }
            //cache
            inputEmail.setText(sharedLogin.getSessionString(EMAIL));
            inputPassword.setText(sharedLogin.getSessionString(PASSWORD));
        }
    }

    @OnClick({R.id.btn_login, R.id.btn_create_account})
    public void onViewClicked(View view) {
        switch (view.getId()) {
            case R.id.btn_login:
                if (TextUtils.isEmpty(inputEmail.getText().toString())) {
                    inputEmail.setError("Kode Daftar Kosong");
                } else if (TextUtils.isEmpty(inputPassword.getText().toString())) {
                    inputPassword.setError("Password Kosong");
                } else if (!TextUtils.isEmpty(inputPassword.getText().toString()) && !TextUtils.isEmpty(inputEmail.getText().toString())) {
                    login(inputEmail.getText().toString(), inputPassword.getText().toString());
                }
                break;
            case R.id.btn_create_account:
                break;
        }
    }

    private void login(String nama, String password) {
        loader.setVisibility(View.VISIBLE);
        //eksekusi
        ApiService service = RetroClient.getApiService();
        Call<ResponseLogin> login = service.signInUser(nama, password);
        login.enqueue(new Callback<ResponseLogin>() {
            @Override
            public void onResponse(Call<ResponseLogin> call, Response<ResponseLogin> response) {
                //cek code apakah sukses atau tidak
                try {
                    if (response.body().getCode() == SUCCESS) {
                        Toast.makeText(Login.this, response.body().getMessage(), Toast.LENGTH_SHORT).show();
                        List<UserItem> dataUser = response.body().getUser();
                        //simpan di sharef pref
                        //simpan id_user, nama_user, email dan password
                        sharedLogin.saveSessionString(ID, dataUser.get(0).getId());
                        sharedLogin.saveSessionString(KODE, dataUser.get(0).getKodeDaftar());
                        sharedLogin.saveSessionString(NAMA, dataUser.get(0).getNama());
                        sharedLogin.saveSessionString(EMAIL, dataUser.get(0).getEmail());
                        sharedLogin.saveSessionString(ALAMAT, dataUser.get(0).getAlamat());
                        sharedLogin.saveSessionString(PASSWORD, dataUser.get(0).getPassword());
                        //buat cache
                        sharedLogin.saveSPBoolean(SP_SUDAH_LOGIN, true);
                        //cek login
                        sharedLogin.saveSPBoolean(SP_SUDAH_LOGIN2, true);
                        loader.setVisibility(View.INVISIBLE);
                        //buka home jika berhasil login
                        startActivity(new Intent(Login.this, MainActivity.class)
                                .addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP | Intent.FLAG_ACTIVITY_NEW_TASK));
                        //hancurkan activity
                        finish();
                    } else {
                        loader.setVisibility(View.INVISIBLE);
                        Toast.makeText(Login.this, response.body().getMessage(), Toast.LENGTH_SHORT).show();
                    }
                } catch (Exception e) {
                    Toast.makeText(Login.this, "Akun tidak ditemukan", Toast.LENGTH_SHORT).show();
                }
            }

            @Override
            public void onFailure(Call<ResponseLogin> call, Throwable t) {
                //hilangkan loading
                loader.setVisibility(View.INVISIBLE);
                Toast.makeText(Login.this, "Koneksi Gagal Keserver", Toast.LENGTH_SHORT).show();
            }
        });
    }

}