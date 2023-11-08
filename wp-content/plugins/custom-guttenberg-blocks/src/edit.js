/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';
import {
	useBlockProps,
	MediaPlaceholder,
	BlockControls,
	RichText
} from '@wordpress/block-editor';
import { Button, ToolbarGroup, ToolbarButton } from '@wordpress/components';

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {Element} Element to render.
 */

const {Fragment} = wp.element;

export default function Edit({ attributes, setAttributes}) {
	const blockProps = useBlockProps();
	return (
		<fragment>
			<div {...blockProps}>
				<BlockControls>
					{
						attributes.url && (
							<ToolbarGroup>
								<ToolbarButton
									onClick={() => setAttributes({id:'',url:'',alt:''})}
									icon="trash"
								>
									Delete Image
								</ToolbarButton>
							</ToolbarGroup>
						)
					}
				</BlockControls>


				{
					attributes.url ? (
						<img src={attributes.url} alt={attributes.alt}/>
					):(

					<MediaPlaceholder
						onSelect={(media) => setAttributes({
							id:media.id,
							url:media.url,
							alt:media.alt
						})}
						allowedTypes={['image']}
						multiple = {false}
						labels={{'title': "Insert Image for you post"}}
					/>
					)
				}
				<div className="right-column">
				<RichText
					tagName="h2"
					className='custom-guttenberg-block-title'
					value={attributes.heading}
					onChange={(value) => setAttributes({ heading:value })}
					placeholder="Enter the title text"
				/>
				<RichText
					tagName="h4"
					className='custom-guttenberg-block-subtitle'
					value={attributes.subheading}
					onChange={(value) => setAttributes({ subheading:value })}
					placeholder="Enter the subtitle text"
				/>
				<RichText
					tagName="p"
					className='custom-guttenberg-block-content'
					value={attributes.content}
					onChange={(value) => setAttributes({ content:value })}
					placeholder="Enter the content text"
				/>
				</div>
			</div>
		</fragment>
	);
}
