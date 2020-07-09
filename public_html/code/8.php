<!DOCTYPE html>
<html>
    <head></head>
<title>1</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" type="text/css" href="mystyle.css">
</head>
<body class="w3-container">

<h2>User </h2>

<div class="w3-panel w3-card w3-light-grey">
  <h3>Order.java - Order Activity</h3>
  <div class="w3-container w3-white">

      <textarea spellcheck="false" rows="25" cols="135">
public class Order extends AppCompatActivity {
    private FirebaseAuth mAuth;
    private FirebaseUser mCurrentUser;
    private EditText Description,Comment_Src,Comment_Dest,Receiver_Name,Receiver_Phone,Receiver_Address;
    private RadioGroup radioGroup;
    private RadioButton weightButton;
    private  AlertDialog.Builder builder;
    private ImageView srcimage,destimage;
     String slat,slng,dlat,dlng;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_order);

        mAuth = FirebaseAuth.getInstance();
        mCurrentUser = mAuth.getCurrentUser();

        Description=findViewById(R.id.Description);
        Comment_Src=findViewById(R.id.Comment_Src);
        Comment_Dest=findViewById(R.id.Comment_Dest);
        Receiver_Name=findViewById(R.id.Receiver_Name);
        Receiver_Phone=findViewById(R.id.Receiver_Phone);
        Receiver_Address=findViewById(R.id.Receiver_Address);
        radioGroup=findViewById(R.id.radioGroup);
        srcimage=findViewById(R.id.srcimage);
        destimage=findViewById(R.id.destimage);
        builder= new AlertDialog.Builder(this);
        dlat="";slng="";
    }

    public void back(View view) {
        onBackPressed();
    }

    public void addOrder(View view) {
        if (Description.getText().toString().isEmpty())
        {
            Description.setError("Describe Product");
        }
        else if(Receiver_Name.getText().toString().isEmpty())
        {
            Receiver_Name.setError("Enter Name");
        }
        else if(Receiver_Phone.getText().toString().isEmpty())
        {
            Receiver_Phone.setError("Enter Phone");
        }
        else if(Receiver_Address.getText().toString().isEmpty())
        {
            Receiver_Address.setError("Enter Address");
        }
        else if(slng.equals("")||dlat.equals(""))
        {
            Receiver_Address.setError("Please Select Location from map");
        }
        else {
            
            addOrderUser();
        }
    }
    private void addOrderUser()
    {
        final String phoneString = mCurrentUser.getPhoneNumber();
        final String descriptionString = Description.getText().toString();
        final String csrcString = Comment_Src.getText().toString();
        final String sourceString = slat+";"+slng;
        final String cdestString = Comment_Dest.getText().toString();
        final String addressString = Receiver_Address.getText().toString();
        final String destinationString = dlat+";"+dlng;
        final String rphoneString = "+91"+Receiver_Phone.getText().toString();
        final String nameString = Receiver_Name.getText().toString();
         weightButton=findViewById(radioGroup.getCheckedRadioButtonId());
        final String weightString = weightButton.getText().toString();


        StringRequest stringRequest = new StringRequest(Request.Method.POST, Constants.URL_ADDORDER,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        try {
                            JSONObject jsonObject = new JSONObject(response);


                            Toast.makeText(getApplicationContext(), jsonObject.getString("message"), Toast.LENGTH_SHORT).show();
                            if(jsonObject.getString("order").equals("true"))
                            {

                                //Setting message manually and performing action on button click
                                builder.setMessage("Order Successfully Placed")
                                        .setCancelable(false)
                                        .setPositiveButton("Back", new DialogInterface.OnClickListener() {
                                            public void onClick(DialogInterface dialog, int id) {
                                                finish();
                                                        onBackPressed();
                                            }
                                        });
                                AlertDialog alert = builder.create();
                                //Setting the title manually
                                alert.setTitle("Order Status");
                                alert.show();
                            }
                            //Snackbar.make(linearLayout,"Verified...",Snackbar.LENGTH_SHORT).show();



                        } catch (JSONException e) {
                            e.printStackTrace();
                            Toast.makeText(getApplicationContext(),e.getMessage() , Toast.LENGTH_SHORT).show();
                        }

                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Toast.makeText(getApplicationContext(), error.getMessage(), Toast.LENGTH_SHORT).show();
                    }
                }) {
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();
                params.put("Weight",weightString);
                params.put("Description", descriptionString);
                params.put("Comment_Src", csrcString);
                params.put("Source", sourceString);
                params.put("Receiver_Name", nameString);
                params.put("Receiver_Phone", rphoneString);
                params.put("Receiver_Address", addressString);
                params.put("Destination", destinationString);
                params.put("Comment_Dest",cdestString);
                params.put("Phone",phoneString);

                return params;
            }
        };


        /*RequestQueue requestQueue = Volley.newRequestQueue(this);
        requestQueue.add(stringRequest);*/
        RequestHandler.getInstance(this).addToRequestQueue(stringRequest);

    }

    public void srcMap(View view) {
        if(isServicesOk()) {
            Intent intent = new Intent(this, MapsActivity.class);
            intent.putExtra("activity","pickup");
            startActivityForResult(intent,1);
        }
    }

    public void destMap(View view) {
        if (isServicesOk()) {
            Intent intent = new Intent(this, MapsActivity.class);
            intent.putExtra("activity","delivery");
            startActivityForResult(intent, 2);
        }
    }
    public boolean isServicesOk()
    {
        int available = GoogleApiAvailability.getInstance().isGooglePlayServicesAvailable(Order.this);

        if(available== ConnectionResult.SUCCESS){

            return true;
        }
        else if(GoogleApiAvailability.getInstance().isUserResolvableError(available))
        {
            Dialog dialog = GoogleApiAvailability.getInstance().getErrorDialog(Order.this,available,9001);
            dialog.show();
        }
        else
        {
            Toast.makeText(this,"Error",Toast.LENGTH_SHORT).show();
        }
        return false;
    }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data)
    {
        super.onActivityResult(requestCode, resultCode, data);
        // check if the request code is same as what is passed  here it is 2
        if(requestCode==1)
        {
            slat=data.getStringExtra("slat");
            slng=data.getStringExtra("slng");
            srcimage.setImageResource(R.drawable.ic_action_tick);
            Toast.makeText(this,data.getStringExtra("activity")+"location set",Toast.LENGTH_SHORT).show();
        }
        if(requestCode==2)
        {
            dlat=data.getStringExtra("dlat");
            dlng=data.getStringExtra("dlng");
            destimage.setImageResource(R.drawable.ic_action_tick);
            Toast.makeText(this,data.getStringExtra("activity")+"location set",Toast.LENGTH_SHORT).show();
        }
    }
}



</textarea>
    
  </div>
</div>

</body>