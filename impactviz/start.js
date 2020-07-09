
var identifier = "10.1038/520429a"; // NOTE: for testing
// var identifier = document.getElementsByName('citation_doi')[0].getAttribute('content');

var options = {
  entities: $('#impactviz-overview').attr('entities-path'),
  indicators: $('#impactviz-overview').attr('indicators-path'),
  customize: $('#impactviz-overview').attr('customize-path'),
  img: $('#impactviz-overview').attr('img-path')
}

impact = new ImpactViz(identifier, options);
impact.initViz();
