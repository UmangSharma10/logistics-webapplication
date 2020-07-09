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
  <h3>MapsActivity.java - MapsActivity Activity</h3>
  <div class="w3-container w3-white">

      <textarea spellcheck="false" rows="25" cols="135">

public class MapsActivity extends AppCompatActivity implements OnMapReadyCallback {

    private static final int REQUEST_LOCATION_PERMISSION = 1;
    private GoogleMap mMap;
    int MARKER_lIMIT = 1;
    private String activity;
    private LatLng latLngx;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_maps);
        Toolbar toolbar=findViewById(R.id.toolbar);
       // getSupportActionBar().hide();
        setSupportActionBar(toolbar);
        // Obtain the SupportMapFragment and get notified when the map is ready to be used.
        SupportMapFragment mapFragment = (SupportMapFragment) getSupportFragmentManager()
                .findFragmentById(R.id.map);
        mapFragment.getMapAsync(this);
        Intent intent = getIntent();
         activity = intent.getStringExtra("activity");
    }



    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        MenuInflater inflater = getMenuInflater();
        inflater.inflate(R.menu.map_options, menu);
        return true;
    }
    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Change the map type based on the user's selection.
        switch (item.getItemId()) {
            case R.id.normal_map:
                mMap.setMapType(GoogleMap.MAP_TYPE_NORMAL);
                return true;
            case R.id.hybrid_map:
                mMap.setMapType(GoogleMap.MAP_TYPE_HYBRID);
                return true;
            case R.id.satellite_map:
                mMap.setMapType(GoogleMap.MAP_TYPE_SATELLITE);
                return true;
            case R.id.terrain_map:
                mMap.setMapType(GoogleMap.MAP_TYPE_TERRAIN);
                return true;
            default:
                return super.onOptionsItemSelected(item);
        }
    }

    /**
     * Manipulates the map once available.
     * This callback is triggered when the map is ready to be used.
     * This is where we can add markers or lines, add listeners or move the camera. In this case,
     * we just add a marker near Sydney, Australia.
     * If Google Play services is not installed on the device, the user will be prompted to install
     * it inside the SupportMapFragment. This method will only be triggered once the user has
     * installed Google Play services and returned to the app.
     */
    @Override
    public void onMapReady(GoogleMap googleMap) {
        mMap = googleMap;

        // Add a marker in Sydney and move the camera
        LatLng home = new LatLng(22.994947, 72.592829);
        mMap.addMarker(new MarkerOptions().position(home).title("Home"));
        // mMap.moveCamera(CameraUpdateFactory.newLatLng(home));
        mMap.moveCamera(CameraUpdateFactory.newLatLngZoom(home, 20));
        setMapLongClick(mMap);
        enableMyLocation();
    }
    private void setMapLongClick(final GoogleMap map) {
        map.setOnMapLongClickListener(new GoogleMap.OnMapLongClickListener() {
            @Override
            public void onMapLongClick(LatLng latLng) {
                if (MARKER_lIMIT == 1) {
                    map.addMarker(new MarkerOptions().position(latLng).title(latLng.toString()));
                    latLngx=latLng;
                    MARKER_lIMIT++;
                }
                //map.addMarker(new MarkerOptions().position(latLng).title(latLng.toString()));

            }
        });
    }



    private void enableMyLocation() {
        if (ContextCompat.checkSelfPermission(this,
                Manifest.permission.ACCESS_FINE_LOCATION)
                == PackageManager.PERMISSION_GRANTED) {
            mMap.setMyLocationEnabled(true);
        } else {
            ActivityCompat.requestPermissions(this, new String[]
                            {Manifest.permission.ACCESS_FINE_LOCATION},
                    REQUEST_LOCATION_PERMISSION
            );
        }
    }

    @Override
    public void onRequestPermissionsResult(int requestCode,
                                           @NonNull String[] permissions,
                                           @NonNull int[] grantResults) {
        // Check if location permissions are granted and if so enable the
        // location data layer.
        switch (requestCode) {
            case REQUEST_LOCATION_PERMISSION:
                if (grantResults.length > 0
                        && grantResults[0]
                        == PackageManager.PERMISSION_GRANTED) {
                    enableMyLocation();
                    break;
                }
        }
    }

    public void button(View view) {
        if(activity.equals("pickup")) {
            if (MARKER_lIMIT != 1) {
                Intent intent = new Intent();
                intent.putExtra("slat", Double.toString(latLngx.latitude));
                intent.putExtra("slng", Double.toString(latLngx.longitude));
                intent.putExtra("activity", "pickup");
                setResult(1, intent);
                finish();//finishing activity
            }
        }
        if(activity.equals("delivery")) {
            if (MARKER_lIMIT != 1) {
                Intent intent = new Intent();
                intent.putExtra("dlat", Double.toString(latLngx.latitude));
                intent.putExtra("dlng", Double.toString(latLngx.longitude));
                intent.putExtra("activity", "delivery");
                setResult(2, intent);
                finish();//finishing activity
            }
        }
    }

    @Override
    public void onBackPressed() {
        Toast.makeText(this,"Set Location",Toast.LENGTH_SHORT).show();
    }
}


</textarea>
    
  </div>
</div>

</body>