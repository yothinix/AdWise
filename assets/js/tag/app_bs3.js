var elt = $('.example_typeahead > > input');

elt.tagsinput();
elt.tagsinput('input').typeahead({
  prefetch: 'http://localhost/AdWise/assets/tags.json'
}).bind('typeahead:selected', $.proxy(function (obj, datum) {  
	this.tagsinput('add', datum.value);
	this.tagsinput('input').typeahead('setQuery', '');
}, elt));
