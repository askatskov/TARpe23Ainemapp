import { store as blockEditorStore } from '@wordpress/block-editor';
import { Button, Spinner } from '@wordpress/components';
import { useSelect, useDispatch } from '@wordpress/data';
import { store as editPostStore } from '@wordpress/edit-post';
import { useState } from '@wordpress/element';
import { __ } from '@wordpress/i18n';
import { AnimatePresence, motion } from 'framer-motion';
import { addImageToBlock, downloadImage } from '@draft/api/WPApi';

export const ImagePreview = ({
	prompt,
	size,
	isGenerating,
	id,
	src,
	clearImageResponse,
}) => {
	const { openGeneralSidebar } = useDispatch(editPostStore);
	const { updateBlockAttributes } = useDispatch(blockEditorStore);
	const [isInserting, setIsInserting] = useState(false);
	const selectedBlock = useSelect(
		(select) => select(blockEditorStore).getSelectedBlock(),
		[],
	);
	const [imgWidth, imgHeight] = size.split('x');

	const handleInsert = async (event) => {
		event.preventDefault();
		setIsInserting(true);
		const image = await downloadImage(id, src, 'ai-generated');
		if (!image) return;

		await addImageToBlock(selectedBlock, image, updateBlockAttributes);
		setIsInserting(false);
		openGeneralSidebar('edit-post/block');
		clearImageResponse();
	};

	if (src === '' && !isGenerating) return null;

	return (
		<div className="flex flex-col gap-5">
			<AnimatePresence>
				{isGenerating ? (
					<motion.div
						initial={{ opacity: 1 }}
						exit={{ opacity: 0 }}
						className="flex aspect-square w-full items-center justify-center"
						style={{
							background:
								'linear-gradient(135deg, #E8E8E8 47.92%, #F3F3F3 60.42%, #E8E8E8 72.92%)',
						}}>
						<Spinner style={{ height: '48px', width: '48px' }} />
					</motion.div>
				) : (
					<motion.div
						initial={{ opacity: 0 }}
						animate={{ opacity: 1 }}
						className="bg-gray-100"
						style={{ aspectRatio: Number(imgWidth) / Number(imgHeight) }}>
						<img
							alt={prompt}
							src={src}
							className="block w-full"
							style={{ aspectRatio: Number(imgWidth) / Number(imgHeight) }}
						/>
					</motion.div>
				)}
			</AnimatePresence>
			{isGenerating ? (
				<p>
					{__('Generating your image: ', 'extendify-local')}
					<span className="font-bold">&quot;{prompt}&quot;</span>
				</p>
			) : (
				<form onSubmit={handleInsert} className="flex flex-col gap-5">
					<Button
						type="submit"
						autoFocus
						className="w-full justify-center"
						variant="primary"
						disabled={isInserting}>
						{isInserting
							? // translators: "Importing image" means the image is being added to the WordPress post editor
								__('Importing image...', 'extendify-local')
							: __('Use this image', 'extendify-local')}
					</Button>
					<Button
						className="w-full justify-center bg-gray-200 text-gray-800 disabled:bg-gray-300 disabled:text-gray-700"
						onClick={clearImageResponse}
						disabled={isInserting}>
						{__('Delete image', 'extendify-local')}
					</Button>
				</form>
			)}
		</div>
	);
};
