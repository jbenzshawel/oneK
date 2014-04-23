<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" 
 xmlns:dc="http://purl.org/dc/elements/1.1/" 
 xmlns:media="http://search.yahoo.com/mrss/"
 xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

 <xsl:output method="html" doctype-system="http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"/>
	<xsl:template match="/">  
		<xsl:for-each select="rss/channel/item" >
			<!--POST-->
			<ul class="post">
				<xsl:variable name="postLink" select="link" />
				<li><a href="{$postLink}" target="_blank"><xsl:value-of select="title"/></a></li>
				<xsl:variable name="descriptionCheck" select="description" />
				<xsl:if test="not(contains($descriptionCheck, 'img'))">
					<li><img src="http://placehold.it/75x75" /></li>
				</xsl:if>
				<xsl:if test="contains($descriptionCheck, 'gifs')">
					<li><img src="http://placehold.it/75x75" /></li>
				</xsl:if>
				<li><xsl:value-of select="description" disable-output-escaping="yes"/></li>
			</ul>
		</xsl:for-each>
	</xsl:template>
</xsl:stylesheet>