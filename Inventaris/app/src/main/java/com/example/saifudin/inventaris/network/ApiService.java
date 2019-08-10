package com.example.saifudin.inventaris.network;

import com.example.saifudin.inventaris.model.ResponseInput;
import com.example.saifudin.inventaris.model.ResponseLaporan;
import com.example.saifudin.inventaris.model.ResponseLogin;
import com.example.saifudin.inventaris.model.ka.ResponseInsert;

import okhttp3.MultipartBody;
import retrofit2.Call;
import retrofit2.http.DELETE;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.GET;
import retrofit2.http.Multipart;
import retrofit2.http.POST;
import retrofit2.http.PUT;
import retrofit2.http.Part;
import retrofit2.http.Path;
import retrofit2.http.Query;

public interface ApiService {
    @GET("api/laporan/")
    Call<ResponseLaporan> getLaporan(@Query("kode") String kode);

    @GET("api/laporan/")
    Call<ResponseLaporan> getLaporanYear(@Query("kode") String kode, @Query("year") String year);

    @FormUrlEncoded
    @POST("api/laporan/")
    Call<ResponseInsert> insertLap(@Field("kode") String kode, @Field("nama") String nama, @Field("jenis") int jenis,
                                  @Field("jumlah") String jumlah, @Field("status") String status, @Field("tanggal") String tanggal,
                                   @Field("kategori") String kategori);

    @FormUrlEncoded
    @POST("api/laporan/")
    Call<ResponseInput> deleteLap(@Field("id") String id);

    @FormUrlEncoded
    @PUT("api/laporan/")
    Call<ResponseInput> updateLap(@Field("id") String id, @Field("kode") String kode, @Field("nama") String nama,
                                   @Field("jenis") int jenis, @Field("jumlah") String jumlah, @Field("status") String status,
                                   @Field("tanggal") String tanggal, @Field("kategori") String kategori);

    @FormUrlEncoded
    @POST("api/login/")
    Call<ResponseLogin> signInUser(@Field("kode") String kode,
                                   @Field("password") String password);

    @FormUrlEncoded
    @PUT("api/pengguna/")
    Call<ResponseInput> updateUser(@Field("kode") String kode, @Field("nama") String nama, @Field("email") String email,
                                  @Field("alamat") String alamat, @Field("password") String password,
                                   @Field("id") String id);

    @Multipart
    @POST("create/laporan.php")
    Call<ResponseInsert> insertLaporan(@Part("kode") String kode,
                                       @Part("nama") String nama,
                                       @Part("jenis") int jenis,
                                       @Part("jumlah") String jumlah,
                                       @Part("status") String status,
                                       @Part("tanggal") String tanggal,
                                       @Part("kategori") String kategori,
                                       @Part MultipartBody.Part image);
}