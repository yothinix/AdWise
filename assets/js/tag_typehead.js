$('.example_typeahead > > input').tagsinput({
  typeahead: {
    source: function(query) {
      return $.getJSON('http://localhost/project/assets/tags.json');
    }
  }
});

$('.occupation > > input').tagsinput({
  typeahead: {
    source: function(query) {
      return $.getJSON('http://localhost/project/assets/ocp.json');
    }
  }
});

$('.academic > > input').tagsinput({
  typeahead: {
    source: function(query) {
      return $.getJSON('http://localhost/project/assets/aca.json');
    }
  }
});
