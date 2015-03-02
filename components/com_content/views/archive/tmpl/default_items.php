<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');
$params = $this->params;
?>

<div id="archive-items">
	<?php foreach ($this->items as $i => $item) : ?>
		<?php $info = $item->params->get('info_block_position', 0); ?>
		<div class="row<?php echo $i % 2; ?>"  >
			<div class="page-header">
				<h2 >
					<?php if ($params->get('link_titles')) : ?>
						<a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($item->slug, $item->catslug)); ?>" >
							<?php echo $this->escape($item->title); ?>
						</a>
					<?php else: ?>
						<?php echo $this->escape($item->title); ?>
					<?php endif; ?>
				</h2>
				<?php if ($params->get('show_author') && !empty($item->author )) : ?>
					<div class="createdby"   >
					<?php $author = ($item->created_by_alias) ? $item->created_by_alias : $item->author; ?>
					<?php $author = '<span >' . $author . '</span>'; ?>
						<?php if (!empty($item->contact_link) && $params->get('link_author') == true) : ?>
							<?php echo JText::sprintf('COM_CONTENT_WRITTEN_BY', JHtml::_('link', $this->item->contact_link, $author, array())); ?>
						<?php else: ?>
							<?php echo JText::sprintf('COM_CONTENT_WRITTEN_BY', $author); ?>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>
		<?php $useDefList = ($params->get('show_modify_date') || $params->get('show_publish_date') || $params->get('show_create_date')
			|| $params->get('show_hits') || $params->get('show_category') || $params->get('show_parent_category')); ?>
		<?php if ($useDefList && ($info == 0 || $info == 2)) : ?>
			<div class="article-info muted">
				<dl class="article-info">
				<dt class="article-info-term">
					<?php echo JText::_('COM_CONTENT_ARTICLE_INFO'); ?>
				</dt>

				<?php if ($params->get('show_parent_category') && !empty($item->parent_slug)) : ?>
					<dd>
						<div class="parent-category-name">
							<?php $title = $this->escape($item->parent_title); ?>
							<?php if ($params->get('link_parent_category') && !empty($item->parent_slug)) : ?>
								<?php $url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($item->parent_slug)) . '" >' . $title . '</a>'; ?>
								<?php echo JText::sprintf('COM_CONTENT_PARENT', $url); ?>
							<?php else : ?>
								<?php echo JText::sprintf('COM_CONTENT_PARENT', '<span >' . $title . '</span>'); ?>
							<?php endif; ?>
						</div>
					</dd>
				<?php endif; ?>
				<?php if ($params->get('show_category')) : ?>
					<dd>
						<div class="category-name">
							<?php $title = $this->escape($item->category_title); ?>
							<?php if ($params->get('link_category') && $item->catslug) : ?>
								<?php $url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($item->catslug)) . '" >' . $title . '</a>'; ?>
								<?php echo JText::sprintf('COM_CONTENT_CATEGORY', $url); ?>
							<?php else : ?>
								<?php echo JText::sprintf('COM_CONTENT_CATEGORY', '<span >' . $title . '</span>'); ?>
							<?php endif; ?>
						</div>
					</dd>
				<?php endif; ?>

				<?php if ($params->get('show_publish_date')) : ?>
					<dd>
						<div class="published">
							<span class="icon-calendar"></span>
							<span >
								<?php echo JText::sprintf('COM_CONTENT_PUBLISHED_DATE_ON', JHtml::_('date', $item->publish_up, JText::_('DATE_FORMAT_LC3'))); ?>
							</span>
						</div>
					</dd>
				<?php endif; ?>

				<?php if ($info == 0) : ?>
					<?php if ($params->get('show_modify_date')) : ?>
						<dd>
							<div class="modified">
								<span class="icon-calendar"></span>
								<span  >
									<?php echo JText::sprintf('COM_CONTENT_LAST_UPDATED', JHtml::_('date', $item->modified, JText::_('DATE_FORMAT_LC3'))); ?>
								</span>
							</div>
						</dd>
					<?php endif; ?>
					<?php if ($params->get('show_create_date')) : ?>
						<dd>
							<div class="create">
								<span class="icon-calendar"></span>
								<span  >
									<?php echo JText::sprintf('COM_CONTENT_CREATED_DATE_ON', JHtml::_('date', $item->created, JText::_('DATE_FORMAT_LC3'))); ?>
								</span>
							</div>
						</dd>
					<?php endif; ?>

					<?php if ($params->get('show_hits')) : ?>
						<dd>
							<div class="hits">
								<span class="icon-eye-open"></span> 
								
								<?php echo JText::sprintf('COM_CONTENT_ARTICLE_HITS', $item->hits); ?>
							</div>
						</dd>
					<?php endif; ?>
				<?php endif; ?>
				</dl>
			</div>
		<?php endif; ?>

		<?php if (!$params->get('show_intro')) : ?>
			<?php echo $item->event->afterDisplayTitle; ?>
		<?php endif; ?>
		<?php echo $item->event->beforeDisplayContent; ?>
		<?php if ($params->get('show_intro')) :?>
			<div class="intro" > <?php echo JHtml::_('string.truncateComplex', $item->introtext, $params->get('introtext_limit')); ?> </div>
		<?php endif; ?>

		<?php if ($useDefList && ($info == 1 || $info == 2)) : ?>
			<div class="article-info muted">
				<dl class="article-info">
				<dt class="article-info-term"><?php echo JText::_('COM_CONTENT_ARTICLE_INFO'); ?></dt>

				<?php if ($info == 1) : ?>
					<?php if ($params->get('show_parent_category') && !empty($item->parent_slug)) : ?>
						<dd>
							<div class="parent-category-name">
								<?php $title = $this->escape($item->parent_title); ?>
								<?php if ($params->get('link_parent_category') && $item->parent_slug) : ?>
									<?php $url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($item->parent_slug)) . '" >' . $title . '</a>'; ?>
									<?php echo JText::sprintf('COM_CONTENT_PARENT', $url); ?>
								<?php else : ?>
									<?php echo JText::sprintf('COM_CONTENT_PARENT', '<span >' . $title . '</span>'); ?>
								<?php endif; ?>
							</div>
						</dd>
					<?php endif; ?>
					<?php if ($params->get('show_category')) : ?>
						<dd>
							<div class="category-name">
								<?php $title = $this->escape($item->category_title); ?>
								<?php if ($params->get('link_category') && $item->catslug) : ?>
									<?php $url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($item->catslug)) . '" >' . $title . '</a>'; ?>
									<?php echo JText::sprintf('COM_CONTENT_CATEGORY', $url); ?>
								<?php else : ?>
									<?php echo JText::sprintf('COM_CONTENT_CATEGORY', '<span >' . $title . '</span>'); ?>
								<?php endif; ?>
							</div>
						</dd>
					<?php endif; ?>
					<?php if ($params->get('show_publish_date')) : ?>
						<dd>
							<div class="published">
								<span class="icon-calendar"></span>
								<span  >
									<?php echo JText::sprintf('COM_CONTENT_PUBLISHED_DATE_ON', JHtml::_('date', $item->publish_up, JText::_('DATE_FORMAT_LC3'))); ?>
								</span>
							</div>
						</dd>
					<?php endif; ?>
				<?php endif; ?>

				<?php if ($params->get('show_create_date')) : ?>
					<dd>
						<div class="create">
							<span class="icon-calendar"></span>
							<span  >
								<?php echo JText::sprintf('COM_CONTENT_CREATED_DATE_ON', JHtml::_('date', $item->modified, JText::_('DATE_FORMAT_LC3'))); ?>
							</span>
						</div>
					</dd>
				<?php endif; ?>
				<?php if ($params->get('show_modify_date')) : ?>
					<dd>
						<div class="modified">
							<span class="icon-calendar"></span>
							<span  >
								<?php echo JText::sprintf('COM_CONTENT_LAST_UPDATED', JHtml::_('date', $item->modified, JText::_('DATE_FORMAT_LC3'))); ?>
							</span>
						</div>
					</dd>
				<?php endif; ?>
				<?php if ($params->get('show_hits')) : ?>
					<dd>
						<div class="hits">
							<span class="icon-eye-open"></span> 
							
							<?php echo JText::sprintf('COM_CONTENT_ARTICLE_HITS', $item->hits); ?>
						</div>
					</dd>
				<?php endif; ?>
			</dl>
		</div>
		<?php endif; ?>
		<?php echo $item->event->afterDisplayContent; ?>
	</div>
	<?php endforeach; ?>
</div>
<div class="pagination">
	<p class="counter"> <?php echo $this->pagination->getPagesCounter(); ?> </p>
	<?php echo $this->pagination->getPagesLinks(); ?>
</div>
