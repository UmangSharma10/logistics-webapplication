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
  <h3>Profile.java - Profile Activity</h3>
  <div class="w3-container w3-white">

      <textarea spellcheck="false" rows="25" cols="135">

public class Profile extends AppCompatActivity {
    private FirebaseAuth mAuth;
    private FirebaseUser mCurrentUser;
    private TextView num;
    private TextView a,b,c,gender,dob;
    private ProgressBar progressBar;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_profile);
        mAuth = FirebaseAuth.getInstance();
        mCurrentUser = mAuth.getCurrentUser();
        a=findViewById(R.id.a);
        b=findViewById(R.id.b);
        c=findViewById(R.id.c);
        gender=findViewById(R.id.gender);
        dob=findViewById(R.id.dob);

        num=findViewById(R.id.num_details);
        num.setText(mCurrentUser.getPhoneNumber());
        progressBar=findViewById(R.id.progressBar);

        getUserDetails();
    }
    private void getUserDetails() {


        final String phoneString = mCurrentUser.getPhoneNumber().trim();

        StringRequest stringRequest = new StringRequest(Request.Method.POST, Constants.URL_GETDETAILS,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        try {
                            JSONObject jsonObject = new JSONObject(response);
                            //String msg = jsonObject.getString("message");
                            a.setText(jsonObject.getString("Firstname"));
                            b.setText(jsonObject.getString("Lastname"));
                            c.setText(jsonObject.getString("Address"));
                            gender.setText(jsonObject.getString("Gender"));
                            dob.setText(jsonObject.getString("Dob"));
                            //Toast.makeText(getApplicationContext(), jsonObject.getString("message"), Toast.LENGTH_SHORT).show();
                            progressBar.setVisibility(View.INVISIBLE);
                        } catch (JSONException e) {
                            e.printStackTrace();
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
                params.put("Phone", phoneString);
                return params;
            }
        };

        /*RequestQueue requestQueue = Volley.newRequestQueue(this);
        requestQueue.add(stringRequest);*/
        RequestHandler.getInstance(this).addToRequestQueue(stringRequest);
    }

    @Override
    protected void onStart() {
        super.onStart();
        if(mCurrentUser==null) {
            Intent loginIntent = new Intent(this,login.class);
            loginIntent.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
            loginIntent.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK);
            startActivity(loginIntent);
            finish();
        }
    }

    public void back(View view) {
        onBackPressed();
    }

    public void openEdit(View view) {
        Intent editProfileIntent = new Intent(this,EditProfile.class);
        startActivity(editProfileIntent);
    }
}


</textarea>
    
  </div>
</div>

</body>