package com.example.saifudin.inventaris.menus;

import android.app.ProgressDialog;
import android.os.Bundle;
import android.support.design.widget.TextInputEditText;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.RadioButton;
import android.widget.RadioGroup;
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
import static com.example.saifudin.inventaris.constan.Logins.KODE;
import static com.example.saifudin.inventaris.helper.CekEditText.editText;
import static com.example.saifudin.inventaris.helper.ConvertDate.tglHariIni;

public class InsertLap extends AppCompatActivity {

    @BindView(R.id.ic_close)
    ImageView icClose;
    @BindView(R.id.input_nama)
    TextInputEditText inputNama;
    @BindView(R.id.input_jml)
    TextInputEditText inputJml;
    @BindView(R.id.btn_simpan)
    Button btnSimpan;
    Session session;
    int jns;
    @BindView(R.id.rb_bergerak)
    RadioButton rbBergerak;
    @BindView(R.id.rb_tdk_bergrak)
    RadioButton rbTdkBergrak;
    @BindView(R.id.rg)
    RadioGroup rg;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_insert_lap);
        ButterKnife.bind(this);

        session = new Session(this);
        rg.setOnCheckedChangeListener(new RadioGroup.OnCheckedChangeListener() {
            @Override
            public void onCheckedChanged(RadioGroup group, int checkedId) {
                switch (checkedId) {
                    case R.id.rb_bergerak:
                        jns = 1;
                        break;
                    case R.id.rb_tdk_bergrak:
                        jns = 0;
                        break;
                    default:
                        break;
                }
            }
        });
    }

    @OnClick({R.id.ic_close, R.id.btn_simpan})
    public void onViewClicked(View view) {
        switch (view.getId()) {
            case R.id.ic_close:
                finish();
                break;
            case R.id.btn_simpan:
                if (editText(inputNama, "Nama Kosong")) return;
                if (editText(inputJml, "Jumlah Kosong")) return;
                if (editText(inputJml) && editText(inputNama)) {
                    insert(session.getSessionString(KODE), inputNama.getText().toString(), jns,
                            inputJml.getText().toString(), "0", tglHariIni());
                }
                break;
        }
    }

    private void insert(String kode, String nama, int jenis, String jumlah, String status, String tanggal) {
        final ProgressDialog dialog = new ProgressDialog(this);
        dialog.setMessage("Tunggu Sebentar...");

        ApiService service = RetroClient.getApiService();
        Call<ResponseInput> call = service.insertLap(kode, nama, jenis, jumlah, status, tanggal);
        dialog.show();
        call.enqueue(new Callback<ResponseInput>() {
            @Override
            public void onResponse(Call<ResponseInput> call, Response<ResponseInput> response) {
                try {
                    if (response.body().getCode() == SUCCESS) {
                        dialog.dismiss();
                        Toast.makeText(InsertLap.this, response.body().getMessage(), Toast.LENGTH_SHORT).show();
                        inputJml.setText("");
                        inputNama.setText("");
                    } else {
                        Toast.makeText(InsertLap.this, response.body().getMessage(), Toast.LENGTH_SHORT).show();
                        dialog.dismiss();
                    }
                } catch (Exception e) {

                }
            }

            @Override
            public void onFailure(Call<ResponseInput> call, Throwable t) {
                Toast.makeText(InsertLap.this, "" + t.getMessage(), Toast.LENGTH_SHORT).show();
                dialog.dismiss();
            }
        });
    }

}