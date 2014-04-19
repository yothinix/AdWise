$('.example_typeahead > > input').tagsinput({
  typeahead: {
    source: function(query) {
      return $.getJSON('http://adwise.kmi.tl/assets/tags.json');
    }
  }
});

$('.occupation > > input').tagsinput({
  typeahead: {
    source: function(query) {
      return $.getJSON('http://adwise.kmi.tl/assets/ocp.json');
    }
  }
});

$('.academic > > input').tagsinput({
  typeahead: {
    source: function(query) {
      return $.getJSON('http://adwise.kmi.tl/assets/aca.json');
    }
  }
});
