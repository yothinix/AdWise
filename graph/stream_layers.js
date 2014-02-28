
/* Inspired by Lee Byron's test data generator. */
//Example call function using this below...	
//stream_layers(3,128,.1)
//n : number of graph line to generate
//m : number of horizontal point to generate 0 to m
function stream_layers(n, m, o) {
	if (arguments.length < 3) o = 0;
	function bump(a)
	{
		var x = 1 / (.1 + Math.random()),
			y = 2 * Math.random() - .5,
			z = 10 / (.1 + Math.random());
		for (var i = 0; i < m; i++) 
		{
			var w = (i / m - y) * z;
			a[i] += x * Math.exp(-w * w);
		}
	}
	return d3.range(n).map(function() 
	{
		var a = [], i;
		for (i = 0; i < m; i++) a[i] = o + o * Math.random();
		for (i = 0; i < 5; i++) bump(a);
		//alert(JSON.stringify(a.map(stream_index)));
		//document.write(JSON.stringify(a.map(stream_index)));
		return a.map(stream_index);
	});
}



function stream_index(d, i) {
  return {x: i, y: Math.max(0, d)};
}

