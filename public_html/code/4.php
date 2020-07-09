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
  <h3>MainActivity.java - MainActivity Activity</h3>
  <div class="w3-container w3-white">

      <textarea spellcheck="false" rows="25" cols="135">
public class MainActivity extends AppCompatActivity {

    private FirebaseAuth mAuth;
    private FirebaseUser mCurrentUser;
  //  private FirebaseDatabase database;
  //  private DatabaseReference myRef;
     private  AlertDialog.Builder builder;
    private LinearLayout linearLayout;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        mAuth = FirebaseAuth.getInstance();
        mCurrentUser = mAuth.getCurrentUser();

        builder= new AlertDialog.Builder(this);
        linearLayout=findViewById(R.id.mainLayout);




    }

    private void sendUserToLogin() {
        Intent loginIntent = new Intent(this,login.class);
        loginIntent.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
        loginIntent.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK);
        startActivity(loginIntent);
        finish();

    }

    @Override
    protected void onStart() {
        super.onStart();
        if(mCurrentUser==null)
        {
        sendUserToLogin();
        }

    }


    public void logout(View view) {
        builder.setMessage("Do you want to quit?")
                .setCancelable(true)
                .setPositiveButton("Logout", new DialogInterface.OnClickListener() {
                    public void onClick(DialogInterface dialog, int id) {
                        finish();
                        mAuth.signOut();
                        sendUserToLogin();
                    }
                }).setNegativeButton("cancel", new DialogInterface.OnClickListener() {
            public void onClick(DialogInterface dialog, int id) {
            }
        });
        AlertDialog alert = builder.create();
        //Setting the title manually
        alert.setTitle("LOGOUT");
        alert.show();


    }

    public void openAbout(View view) {
        Intent aboutIntent = new Intent(this,About.class);
        startActivity(aboutIntent);

    }

    public void openAddOrder(View view) {
        Intent orderIntent = new Intent(this,Order.class);
        startActivity(orderIntent);
    }

    public void openHistory(View view) {
        Snackbar.make(linearLayout,"Order's History",Snackbar.LENGTH_SHORT).show();
    }

    public void openTrack(View view) {
        Snackbar.make(linearLayout,"Track Delivery",Snackbar.LENGTH_SHORT).show();
    }

    public void openProfile(View view) {
        Snackbar.make(linearLayout,"User's Profile",Snackbar.LENGTH_SHORT).show();
        Intent profileIntent = new Intent(this,Profile.class);
        startActivity(profileIntent);
    }
}


</textarea>
    
  </div>
</div>

</body>