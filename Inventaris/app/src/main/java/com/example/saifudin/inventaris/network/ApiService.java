package com.example.saifudin.inventaris.network;

import com.example.saifudin.inventaris.model.ResponseInput;
import com.example.saifudin.inventaris.model.ResponseLaporan;
import com.example.saifudin.inventaris.model.ResponseLogin;

import retrofit2.Call;
import retrofit2.http.DELETE;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.GET;
import retrofit2.http.POST;
import retrofit2.http.PUT;
import retrofit2.http.Path;
import retrofit2.http.Query;

public interface ApiService {
    @GET("laporan/")
    Call<ResponseLaporan> getLaporan(@Query("kode") String kode);

    @GET("laporan/")
    Call<ResponseLaporan> getLaporanYear(@Query("kode") String kode, @Query("year") String year);

    @FormUrlEncoded
    @POST("laporan/")
    Call<ResponseInput> insertLap(@Field("kode") String kode, @Field("nama") String nama, @Field("jenis") int jenis,
                                  @Field("jumlah") String jumlah, @Field("status") String status, @Field("tanggal") String tanggal);

    @FormUrlEncoded
    @POST("laporan/")
    Call<ResponseInput> deleteLap(@Field("id") String id);

    @FormUrlEncoded
    @PUT("laporan/")
    Call<ResponseInput> updateLap(@Field("id") String id, @Field("kode") String kode, @Field("nama") String nama,
                                   @Field("jenis") int jenis, @Field("jumlah") String jumlah, @Field("status") String status,
                                   @Field("tanggal") String tanggal);

    @FormUrlEncoded
    @POST("login/")
    Call<ResponseLogin> signInUser(@Field("kode") String kode,
                                   @Field("password") String password);

    @FormUrlEncoded
    @PUT("pengguna/")
    Call<ResponseInput> updateUser(@Field("kode") String kode, @Field("nama") String nama, @Field("email") String email,
                                  @Field("alamat") String alamat, @Field("password") String password,
                                   @Field("id") String id);
}