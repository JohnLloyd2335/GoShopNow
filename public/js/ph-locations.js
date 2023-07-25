var my_handlers = {

  fill_provinces:  function(){

      var region_code = $(this).val();
      
      $('#province-selector').ph_locations('fetch_list', [{"region_code": region_code}]);
      $('#region').val($("#region-selector option:selected").text());
      
  },

  fill_cities: function(){

      var province_code = $(this).val();
      $('#city-selector').ph_locations( 'fetch_list', [{"province_code": province_code}]);
      $('#province').val($("#province-selector option:selected").text());
  },


  fill_barangays: function(){

      var city_code = $(this).val();
      $('#barangay').ph_locations('fetch_list', [{"city_code": city_code}]);
      $('#city').val($("#city-selector option:selected").text());
  }
};

$(function(){
  $('#region-selector').on('change', my_handlers.fill_provinces);
  $('#province-selector').on('change', my_handlers.fill_cities);
  $('#city-selector').on('change', my_handlers.fill_barangays);

  $('#region-selector').ph_locations({'location_type': 'regions'});
  $('#province-selector').ph_locations({'location_type': 'provinces'});
  $('#city-selector').ph_locations({'location_type': 'cities'});
  $('#barangay').ph_locations({'location_type': 'barangays'});

  $('#region-selector').ph_locations('fetch_list');
});