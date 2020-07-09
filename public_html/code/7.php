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
  <h3>MainActivity.java - Logout Activity</h3>
  <div class="w3-container w3-white">

      <textarea spellcheck="false" rows="25" cols="135">
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

   private void sendUserToLogin() {
        Intent loginIntent = new Intent(this,login.class);
        loginIntent.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
        loginIntent.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK);
        startActivity(loginIntent);
        finish();

    }
</textarea>
    
  </div>
</div>

</body>