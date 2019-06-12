package com.example.saifudin.inventaris.menus;

import android.app.ProgressDialog;
import android.os.Bundle;
import android.support.design.widget.TextInputEditText;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.Toast;

import com.example.saifudin.inventaris.R;
import com.example.saifudin.inventaris.model.ResponseInput;
import com.example.saifudin.inventaris.network.ApiService;
import com.example.saifudin.inventaris.network.RetroClient;
import com.example.saifudin.inventaris.session.Session;

import butterknife.BindView;
import butterknife.ButterKnife;
import butterknife.OnClick;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

import static com.example.saifudin.inventaris.constan.Koneksi.SUCCESS;
import static com.example.saifudin.inventaris.constan.Logins.ALAMAT;
import static com.example.saifudin.inventaris.constan.Logins.EMAIL;
import static com.example.saifudin.inventaris.constan.Logins.ID;
import static com.example.saifudin.inventaris.constan.Logins.KODE;
import static com.example.saifudin.inventaris.constan.Logins.NAMA;
import static com.example.saifudin.inventaris.constan.Logins.PASSWORD;
import static com.example.saifudin.inventaris.helper.CekEditText.editText;
import static com.example.saifudin.inventaris.helper.ConvertDate.tglHariIni;

public class Profile extends AppCompatActivity {

    @BindView(R.id.ic_close)
    ImageView icClose;
    @BindView(R.id.input_id)
    TextInputEditText inputId;
    @BindView(R.id.input_nama)
    TextInputEditText inputNama;
    @BindView(R.id.input_alamat)
    TextInputEditText inputAlamat;
    @BindView(R.id.input_password)
    TextInputEditText inputPassword;
    @BindView(R.id.btn_simpan)
    Button btnSimpan;
    @BindView(R.id.input_email)
    TextInputEditText inputEmail;
    Session session;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_profile);
        ButterKnife.bind(this);
        session = new Session(this);

        if (session.getSPSudahLogin2()) {
           inputId.setText(session.getSessionString(KODE));
           inputNama.setText(session.getSessionString(NAMA));
           inputEmail.setText(session.getSessionString(EMAIL));
           inputAlamat.setText(session.getSessionString(ALAMAT));
           inputPassword.setText(session.getSessionString(PASSWORD));
        }
    }

    @OnClick({R.id.ic_close, R.id.btn_simpan})
    public void onViewClicked(View view) {
        switch (view.getId()) {
            case R.id.ic_close:
                finish();
                break;
            case R.id.btn_simpan:
                if (editText(inputNama, "Nama Kosong")) return;
                if (editText(inputAlamat, "Alamat Kosong")) return;
                if (editText(inputEmail, "Email Kosong")) return;
                if (editText(inputPassword, "Password Kosong")) return;
                if (editText(inputNama) && editText(inputAlamat)) {
                    update(session.getSessionString(KODE), inputNama.getText().toString(), inputEmail.getText().toString(),
                            inputAlamat.getText().toString(), inputPassword.getText().toString(), session.getSessionString(ID));
                }
                break;
        }
    }

    private void update(final String kode, final String nama, final String email, final String alamat, final String password, final String id) {
        final ProgressDialog dialog = new ProgressDialog(this);
        dialog.setMessage("Tunggu Sebentar...");

        ApiService service = RetroClient.getApiService();
        Call<ResponseInput> call = service.updateUser(kode, nama, email, alamat, password, id);
        dialog.show();
        call.enqueue(new Callback<ResponseInput>() {
            @Override
            public void onResponse(Call<ResponseInput> call, Response<ResponseInput> response) {
                if (response.body().getCode() == SUCCESS) {
                    dialog.dismiss();
                    Toast.makeText(Profile.this, response.body().getMessage(), Toast.LENGTH_SHORT).show();
                    session.saveSessionString(ID, id);
                    session.saveSessionString(KODE, kode);
                    session.saveSessionString(NAMA, nama);
                    session.saveSessionString(EMAIL, email);
                    session.saveSessionString(ALAMAT, alamat);
                    session.saveSessionString(PASSWORD, password);
                } else {
                    Toast.makeText(Profile.this, response.body().getMessage(), Toast.LENGTH_SHORT).show();
                    dialog.dismiss();
                }
            }

            @Override
            public void onFailure(Call<ResponseInput> call, Throwable t) {
                Toast.makeText(Profile.this, "" + t.getMessage(), Toast.LENGTH_SHORT).show();
                dialog.dismiss();
            }
        });
    }

}