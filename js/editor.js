wp.domReady( () => {
	// Add Custom group styles
	wp.blocks.registerBlockStyle(
		'core/group',
		[
			{
				name: 'large-padding',
				label: 'Large Padding',
				isDefault: true,
			},
			{
				name: 'small-padding',
				label: 'Small Padding',
			},
			{
				name: 'medium-padding',
				label: 'Medium Padding',
			},
			{
				name: 'no-padding',
				label: 'No Padding',
			},
		]
	);
	// Add Custom Separator
	wp.blocks.unregisterBlockStyle(
		'core/separator',
		[ 'default', 'wide', 'dots' ]
	);
	wp.blocks.registerBlockStyle( 'core/separator', [ 
		{
			name: 'left-aligned',
			label: 'Left Aligned',
			isDefault: true,
		},
		{
			name: 'centered',
			label: 'Centered',
		},
		{
			name: 'spacer',
			label: 'Spacer',
		},
		{
			name: 'small-spacer',
			label: 'Small Spacer',
		}
	]);
	// Custom Pullquote
	wp.blocks.unregisterBlockStyle(
		'core/pullquote',
		[ 'default', 'solid-color' ]
	);
	wp.blocks.registerBlockStyle( 'core/pullquote', [ 
		{
			name: 'solid',
			label: 'Solid',
			isDefault: true,
		},
		{
			name: 'bordered',
			label: 'Bordered',
		}
	]);
	// Custom heading
	wp.blocks.registerBlockStyle( 'core/heading', [ 
		{
			name: 'default',
			label: 'Default',
			isDefault: true,
		},
		{
			name: 'leader',
			label: 'Leader Text',
		},
		{
			name: 'alternate',
			label: 'Alternate',
		}
	]);
	// Custom button styles
	wp.blocks.unregisterBlockStyle(
		'core/button',
		[ 'fill', 'outline' ]
	);
	wp.blocks.registerBlockStyle( 'core/button', [ 
		{
			name: 'default',
			label: 'Default',
			isDefault: true,
		},
		{
			name: 'alternate',
			label: 'Alternate',
		}
	]);
	// Custom Media & Text
	wp.blocks.registerBlockStyle( 'core/media-text', [ 
		{
			name: 'default',
			label: 'Default',
			isDefault: true,
		},
		{
			name: 'overlap',
			label: 'Overlap',
		},
		{
			name: 'stack',
			label: 'Stack',
		}
	]);
	// Custom List
	wp.blocks.registerBlockStyle( 'core/list', [ 
		{
			name: 'default',
			label: 'Default',
			isDefault: true,
		},
		{
			name: 'columns',
			label: 'Columns',
		},
		{
			name: 'checkmark',
			label: 'Checkmark',
		},
		{
			name: 'checkmark-right',
			label: 'Checkmark on right',
		},
		{
			name: 'inline-list',
			label: 'Inline List',
		}
		
	]);
	// Custom FAQ
	wp.blocks.registerBlockStyle( 'acf/frequently-asked-questions', [ 
		{
			name: 'default',
			label: 'Default',
			isDefault: true,
		},
		{
			name: 'two-column',
			label: 'Two Column',
		}
	]);
} );