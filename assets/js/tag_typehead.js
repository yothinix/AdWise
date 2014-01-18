$('.example_typeahead > > input').tagsinput({
  typeahead: {
    source: function(query) {
      return $.getJSON('http://localhost/project/assets/tags.json');
    }
  }
});
