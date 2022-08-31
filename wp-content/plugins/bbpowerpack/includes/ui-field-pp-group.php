<#

var field   = data.field;
var fields  = field.fields;

var fieldName = '';

if ( data.isMultiple ) {
	fieldName = data.name + '[' + data.index + ']';
} else {
	fieldName = data.name + '[]';
}
#>

<div class="pp-group-fields">
	<#
	for ( var key in fields ) {
		var label         = fields[key]['label'],
			name          = fieldName + '[' + key + ']',
			defaultVal    = ( ( 'undefined' != typeof fields[key]['default'] ) ? fields[key]['default'] : '' ),
			fieldTemplate = wp.template( 'fl-builder-field-' + fields[key]['type'] )( {
				name: name,
				value: ( ( 'undefined' != typeof data.value[key] ) ? data.value[key] : defaultVal ),
				field: fields[key]
			} );
		#>
		<div class="pp-group-field-row">
			<div class="pp-group-field-label">
				<label for="{{name}}">{{{label}}}</label>
			</div>
			<div class="pp-group-field-control">
			{{{fieldTemplate}}}
			</div>
		</div>
		<#
	}
	#>
</div>