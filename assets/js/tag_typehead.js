$('.example_typeahead > > input').tagsinput({
  typeahead: {
    source: function(query) {
      return $.getJSON('http://adwise.kmi.tl/assets/tags.json');
    }
  }
});
