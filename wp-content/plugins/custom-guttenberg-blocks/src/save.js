/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { useBlockProps, RichText } from '@wordpress/block-editor';

/**
 * The save function defines the way in which the different attributes should
 * be combined into the final markup, which is then serialized by the block
 * editor into `post_content`.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#save
 *
 * @return {Element} Element to render.
 */
export default function save({attributes}) {
	const blockProps = useBlockProps.save();
	return (
		<div {...blockProps}>
			{
				attributes.url && (
					<img src={attributes.url} alt={attributes.alt}/>
				)
			}
			<div className='right-column'>
				<RichText.Content className="custom-guttenberg-block-title" tagName="h2" value={attributes.heading}/>
				<RichText.Content className="custom-guttenberg-block-subtitle" tagName="h4" value={attributes.subheading}/>
				<RichText.Content className="custom-guttenberg-block-content" tagName="p" value={attributes.content}/>
			</div>
        </div>
	);
}
