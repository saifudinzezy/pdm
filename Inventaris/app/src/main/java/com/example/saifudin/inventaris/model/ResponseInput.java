package com.example.saifudin.inventaris.model;

import com.google.gson.annotations.SerializedName;

public class ResponseInput{

	@SerializedName("code")
	private int code;

	@SerializedName("message")
	private String message;

	@SerializedName("status")
	private boolean status;

	public void setCode(int code){
		this.code = code;
	}

	public int getCode(){
		return code;
	}

	public void setMessage(String message){
		this.message = message;
	}

	public String getMessage(){
		return message;
	}

	public void setStatus(boolean status){
		this.status = status;
	}

	public boolean isStatus(){
		return status;
	}

	@Override
 	public String toString(){
		return 
			"ResponseInput{" + 
			"code = '" + code + '\'' + 
			",message = '" + message + '\'' + 
			",status = '" + status + '\'' + 
			"}";
		}
}