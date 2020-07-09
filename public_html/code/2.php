<!DOCTYPE html>
<html>
    <head></head>
<title>2</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" type="text/css" href="mystyle.css">
</head>
<body class="w3-container">

<h2>User </h2>

<div class="w3-panel w3-card w3-light-grey">
  <h3>Otp.java - Otp Activity</h3>
  <div class="w3-container w3-white">

      <textarea spellcheck="false" rows="25" cols="135">
  public class Otp extends AppCompatActivity {

    private FirebaseAuth mAuth;
    private FirebaseUser mCurrentUser;

    private EditText mOtp;
    private Button verifyBtn;
    private ProgressBar otpProgressBar;
    private TextView otpError;
    private String mAuthVerificationId;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_otp);
        mAuth = FirebaseAuth.getInstance();
        mCurrentUser = mAuth.getCurrentUser();
        mAuthVerificationId = getIntent().getStringExtra("AuthCredential");

        mOtp = (EditText)findViewById(R.id.editTextOtp);
        otpProgressBar = (ProgressBar)findViewById(R.id.otp_progressbar);
        otpError = (TextView)findViewById(R.id.otp_error);
        verifyBtn=(Button)findViewById(R.id.verify_otp_Button);

        verifyBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                String otp;
                otp = mOtp.getText().toString();
                if(otp.isEmpty())
                {
                    /*otpError.setText("Please Enter Otp");
                    otpError.setVisibility(View.VISIBLE);*/
                    mOtp.setError("Please Enter Otp");
                }
                else
                {
                    otpProgressBar.setVisibility(View.VISIBLE);
                    verifyBtn.setEnabled(false);
                    PhoneAuthCredential credential = PhoneAuthProvider.getCredential(mAuthVerificationId, otp);
                    signInWithPhoneAuthCredential(credential);
                }

            }
        });

    }

    private void signInWithPhoneAuthCredential(PhoneAuthCredential credential) {
        mAuth.signInWithCredential(credential)
                .addOnCompleteListener(this, new OnCompleteListener<AuthResult>() {
                    @Override
                    public void onComplete(@NonNull Task<AuthResult> task) {
                        if (task.isSuccessful()) {
                            // Sign in success, update UI with the signed-in user's information
                                //sendUserToHome();
                            sendUserToDetails();
                            // ...
                        } else {
                            // Sign in failed, display a message and update the UI
                            if (task.getException() instanceof FirebaseAuthInvalidCredentialsException) {
                                // The verification code entered was invalid
                                /*otpError.setText("Enter Valid Otp");
                                otpError.setVisibility(View.VISIBLE);*/
                                mOtp.setError("Enter Valid Otp");
                            }
                        }
                        otpProgressBar.setVisibility(View.INVISIBLE);
                        verifyBtn.setEnabled(true);

                    }
                });
    }

    @Override
    protected void onStart() {
        super.onStart();
        if(mCurrentUser!=null)
        {
            sendUserToHome();
        }

    }
    public void sendUserToHome()
    {
        Intent homeIntent = new Intent(this,MainActivity.class);
        homeIntent.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
        homeIntent.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK);
        startActivity(homeIntent);
        finish();
    }
    public void sendUserToDetails()
    {
        Intent detailsIntent = new Intent(this,Details.class);
        detailsIntent.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
        detailsIntent.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK);
        startActivity(detailsIntent);
        finish();
    }

    @Override
    public void onBackPressed() {
        final AlertDialog.Builder builder = new AlertDialog.Builder(this);builder.setTitle("Otp Verification");
        builder.setMessage("Do you want to exit?");
        builder.setCancelable(false);
        builder.setPositiveButton("Exit", new DialogInterface.OnClickListener() {
            public void onClick(DialogInterface dialog, int id) {
                finish();
                Otp.super.onBackPressed();
            }
        });
        builder.setNegativeButton("Proceed", new DialogInterface.OnClickListener() {
            public void onClick(DialogInterface dialog, int id) {
                dialog.cancel();

            }
        });
        builder.show();
    }


}

</textarea>
    
  </div>
</div>

</body>