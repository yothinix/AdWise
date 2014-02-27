$('.example_typeahead > > input').tagsinput({
  typeahead: {
    source: function(query) {
      return $.getJSON('http://localhost/AdWise/assets/tags.json');
    }
  }
});

$('.occupation > > input').tagsinput({
  typeahead: {
    source: function(query) {
      return $.getJSON('http://localhost/adwise/assets/ocp.json');
    }
  }
});

$('.academic > > input').tagsinput({
  typeahead: {
    source: function(query) {
      return $.getJSON('http://localhost/adwise/assets/aca.json');
    }
  }
});
