<?xml version="1.0" encoding="ISO-8859-1"?>

<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	<xsl:template match="/">
		<html>
			<head>
				<link rel="stylesheet" href="https://www.rockthepatch.com/css/xsl.css" type="text/css"/>
			</head>
			<body>
				<h2>Upcoming Rock the Patch! Events</h2>
				<table border="1px">
					<tr>
						<th>Name of Event</th>
						<th>Description</th>
						<th>Date Posted</th>
						<th>Author</th>
					</tr>
					<xsl:for-each select="rss/channel/item">
						<tr>
							<td>
								<xsl:value-of select="title"/>
							</td>
							<td>
								<xsl:value-of select="description"/>
							</td>
							<td>
								<xsl:value-of select="pubDate"/>
							</td>
							<td>
								<a href="mailto:patches@rockthepatch.com" title="Email Patches">
									<xsl:value-of select="author"/>
								</a>
							</td>
						</tr>
					</xsl:for-each>
				</table>
			</body>
		</html>
	</xsl:template>
</xsl:stylesheet>