$('.example_typeahead > > input').tagsinput({
  typeahead: {
    source: function(query) {
      return $.getJSON('http://localhost/AdWise/assets/tags.json');
    }
  }
});