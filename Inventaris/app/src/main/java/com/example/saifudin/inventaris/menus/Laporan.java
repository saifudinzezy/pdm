package com.example.saifudin.inventaris.menus;

import android.app.AlertDialog;
import android.app.ProgressDialog;
import android.content.ActivityNotFoundException;
import android.content.DialogInterface;
import android.content.Intent;
import android.net.Uri;
import android.os.Bundle;
import android.support.design.widget.TextInputLayout;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.CardView;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.PopupMenu;
import android.support.v7.widget.RecyclerView;
import android.text.Editable;
import android.text.TextWatcher;
import android.util.Log;
import android.view.MenuItem;
import android.view.View;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.Toast;

import com.example.saifudin.inventaris.R;
import com.example.saifudin.inventaris.adapter.LaporanAdapter;
import com.example.saifudin.inventaris.model.LaporanItem;
import com.example.saifudin.inventaris.model.ResponseInput;
import com.example.saifudin.inventaris.model.ResponseLaporan;
import com.example.saifudin.inventaris.network.ApiService;
import com.example.saifudin.inventaris.network.RetroClient;
import com.example.saifudin.inventaris.session.Session;
import com.google.gson.Gson;
import com.wang.avi.AVLoadingIndicatorView;

import java.util.ArrayList;
import java.util.List;

import butterknife.BindView;
import butterknife.ButterKnife;
import butterknife.OnClick;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

import static com.example.saifudin.inventaris.constan.Koneksi.SUCCESS;
import static com.example.saifudin.inventaris.constan.Logins.KODE;

public class Laporan extends AppCompatActivity implements LaporanAdapter.LaporanAdapterListener, PopupMenu.OnMenuItemClickListener {

    @BindView(R.id.ic_close)
    ImageView icClose;
    @BindView(R.id.rv)
    RecyclerView rv;
    @BindView(R.id.input_cari)
    EditText inputCari;
    @BindView(R.id.loader)
    AVLoadingIndicatorView loader;
    List<LaporanItem> hasilPesan;
    public LaporanAdapter adapterLap;
    Session session;
    @BindView(R.id.til)
    TextInputLayout til;
    String id;
    LaporanItem data;
    @BindView(R.id.cv)
    CardView cv;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_laporan);
        ButterKnife.bind(this);

        session = new Session(this);
        rv.setLayoutManager(new LinearLayoutManager(this));
        getLap(session.getSessionString(KODE));

        inputCari.addTextChangedListener(new TextWatcher() {
            @Override
            public void beforeTextChanged(CharSequence charSequence, int i, int i1, int i2) {

            }

            @Override
            public void onTextChanged(CharSequence charSequence, int i, int i1, int i2) {

            }

            @Override
            public void afterTextChanged(Editable editable) {
                //after the change calling the method and passing the search input
                try {
                    if (editable.toString() == null || editable.toString().trim().isEmpty()) {
                        adapterLap.setList(hasilPesan);
                        return;
                    } else {
                        filter(editable.toString());
                    }
                } catch (Exception e) {
                    Log.e("error", e.getMessage());
                }
            }
        });

        rv.addOnScrollListener(new RecyclerView.OnScrollListener() {
            @Override
            public void onScrolled(RecyclerView recyclerView, int dx, int dy) {
                super.onScrolled(recyclerView, dx, dy);
                if (dy > 0 && cv.getVisibility() == View.VISIBLE) {
                    cv.setVisibility(View.GONE);
                } else if (dy < 0 && cv.getVisibility() != View.VISIBLE) {
                    cv.setVisibility(View.VISIBLE);
                }
            }
        });
    }

    private void getLap(String kode) {
        loader.setVisibility(View.VISIBLE);
        ApiService apiService = RetroClient.getApiService();
        Call<ResponseLaporan> call = apiService.getLaporan(kode);
        call.enqueue(new Callback<ResponseLaporan>() {
            @Override
            public void onResponse(Call<ResponseLaporan> call, Response<ResponseLaporan> response) {
                hasilPesan = response.body().getLaporan();
                Log.e("Tag", "Hasil List :" + new Gson().toJson(hasilPesan));
                if (response.body().getCode() == SUCCESS) {
                    try {
                        //
                        ArrayList<LaporanItem> list = new ArrayList<>();
                        list.addAll(hasilPesan);
                        adapterLap = new LaporanAdapter(Laporan.this, list, Laporan.this);
                        //  swipeMain.setRefreshing(false);
                        rv.setAdapter(adapterLap);
                        loader.setVisibility(View.GONE);
                    } catch (Exception e) {

                    }
                } else {
                    Log.e("Tag", "Gagal req data ");
                    loader.setVisibility(View.GONE);
                }
            }

            @Override
            public void onFailure(Call<ResponseLaporan> call, Throwable t) {
                loader.setVisibility(View.GONE);
            }
        });
    }

    private void filter(String text) {
        ArrayList<LaporanItem> filteredValues = new ArrayList<>(hasilPesan);
        for (LaporanItem value : hasilPesan) {
            if (!value.getNamaAsset().toLowerCase().contains(text.toLowerCase())) {
                filteredValues.remove(value);
            }
        }
        adapterLap.setList(filteredValues);
    }

    @Override
    public void onSelect(int index, LaporanItem data, View view) {
        this.id = data.getId();
        this.data = data;
        PopupMenu popup = new PopupMenu(this, view);
        popup.setOnMenuItemClickListener(this);
        popup.inflate(R.menu.popup_menu);
        popup.show();
    }

    @Override
    public boolean onMenuItemClick(MenuItem item) {
        switch (item.getItemId()) {
            case R.id.item1:
                Intent intent = new Intent(Laporan.this, EditLap.class);
                intent.putExtra("data", data);
                startActivity(intent);
                return true;
            case R.id.item2:
                AlertDialog.Builder aleBuilder = new AlertDialog.Builder(Laporan.this);
                //settting judul dan pesan
                aleBuilder.setTitle("Hapus Data");
                aleBuilder
                        .setMessage("Apakah anda yakin ingin menghapus data ini?")
                        .setCancelable(false)
                        .setPositiveButton("Ya", new DialogInterface.OnClickListener() {
                            @Override
                            public void onClick(DialogInterface dialog, int which) {
                                delete(id);
                            }
                        })
                        .setNegativeButton("Tidak", new DialogInterface.OnClickListener() {
                            public void onClick(DialogInterface dialog, int id) {
                                //cancel
                                dialog.cancel();
                            }
                        });
                AlertDialog alertDialog = aleBuilder.create();
                alertDialog.show();
                return true;
            default:
                return false;
        }
    }

    private void delete(String id) {
        final ProgressDialog dialog = new ProgressDialog(this);
        dialog.setMessage("Tunggu Sebentar...");

        ApiService service = RetroClient.getApiService();
        Call<ResponseInput> call = service.deleteLap(id);
        dialog.show();
        call.enqueue(new Callback<ResponseInput>() {
            @Override
            public void onResponse(Call<ResponseInput> call, Response<ResponseInput> response) {
                try {
                    if (response.body().getCode() == SUCCESS) {
                        dialog.dismiss();
                        Toast.makeText(Laporan.this, response.body().getMessage(), Toast.LENGTH_SHORT).show();
                        getLap(session.getSessionString(KODE));
                    } else {
                        Toast.makeText(Laporan.this, response.body().getMessage(), Toast.LENGTH_SHORT).show();
                        dialog.dismiss();
                    }
                } catch (Exception e) {
                    Log.e("error", e.getMessage());
                }
            }

            @Override
            public void onFailure(Call<ResponseInput> call, Throwable t) {
                Toast.makeText(Laporan.this, "" + t.getMessage(), Toast.LENGTH_SHORT).show();
                dialog.dismiss();
                Log.e("error", t.getMessage());
            }
        });
    }

    @OnClick({R.id.ic_close, R.id.cv})
    public void onViewClicked(View view) {
        switch (view.getId()) {
            case R.id.ic_close:
                finish();
                break;
            case R.id.cv:
                String urlString = "http://pdm.codingyuk.site/pcm";
                Intent intent = new Intent(Intent.ACTION_VIEW, Uri.parse(urlString));
                intent.addFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
                intent.setPackage("com.android.chrome");
                try {
                    startActivity(intent);
                } catch (ActivityNotFoundException ex) {
                    Log.e("error", ex.getMessage());
                } catch (Exception e) {
                    Log.e("error", e.getMessage());
                }
                break;
        }
    }
}