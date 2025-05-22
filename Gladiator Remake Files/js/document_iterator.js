/**
 * @file
 * @brief Declares and implements the document cursor class under Chrome browser.
 */

// create namespace
if (!window.SkypeClick2Call)
{
	window.SkypeClick2Call = {};
}



//------------------------------------------------------------------------------



SkypeClick2Call.CreateDocumentCursor = function(rootNode, toStart)
{
  return new this.DocumentCursor(this, rootNode, toStart);
}

/**
 * @brief Constructor.
 * @param node    The root HTML node.
 */
SkypeClick2Call.DocumentCursor = function(theGlobalNamespace, rootNode, toStart)
{
/*
	m_skipFirstChild; ///< If @true then we should not try to get a first child inside MoveNext function.
	m_treeWalker;     ///< The instance of the TreeWalker object.
	m_currentNode;    ///< The root node or node calculated in SetAfter. If not @c null, then it should be returned from the MoveNext w/o moving TreeWalker.
	m_beginOffset;    ///< The offset inside text node.
*/
	//
	this.globalNamespace = theGlobalNamespace;

	this.m_skipFirstChild = false;
	this.m_currentNode    = null;
	this.m_beginOffset    = 0;

	// create a TreeWalker
	try
	{
		this.m_treeWalker = document.createTreeWalker(rootNode, NodeFilter.SHOW_ALL, null, false);

		// should we move current node to the end of the 'range'?
		if (toStart)
		{
			this.m_currentNode = this.m_treeWalker.root;
		}
		else
		{
			this.MoveToTheEnd();
		}
	}
	catch(e)
	{
		// do nothing
		//alert(e.message);
	}
}


/// Implementation of the IDocumentCursor::CloneCursor.
SkypeClick2Call.DocumentCursor.prototype.CloneCursor = function()
{
	var newObject = new this.globalNamespace.DocumentCursor(this.globalNamespace, this.m_treeWalker.root, true);
	newObject.m_treeWalker.currentNode = this.m_treeWalker.currentNode;
	newObject.m_skipFirstChild = this.m_skipFirstChild;
	newObject.m_currentNode    = this.m_currentNode;
	newObject.m_beginOffset    = this.m_beginOffset;

	return newObject;
}

/**
 * @brief Returns the root node
 * @return The reference to the root DOM node.
 */
SkypeClick2Call.DocumentCursor.prototype.GetRootNode = function()
{
	return this.m_treeWalker.root;
}

/**
 * @brief Returns the start offset inside text node.
 * @return The offset inside text node.
 */
SkypeClick2Call.DocumentCursor.prototype.SetBeginOffset = function(offset)
{
	this.m_beginOffset = offset;
}

/**
 * @brief Returns the start offset inside text node.
 * @return The offset inside text node.
 */
SkypeClick2Call.DocumentCursor.prototype.GetBeginOffset = function()
{
	return this.m_beginOffset;
}

/// Implementation of the IDocumentCursor::SetAfter.
SkypeClick2Call.DocumentCursor.prototype.SetAfter = function(node)
{
	var result = this.globalNamespace.OK;
	try
	{
		// reset offset to zero
		this.m_beginOffset = 0;

		// move TreeWalker to the given node
		this.m_treeWalker.currentNode = node;

		// ... and then to the next sibling (search for next sibling or sibling of the parent element)
		// and change current node
		while (true)
		{
			this.m_currentNode = this.m_treeWalker.nextSibling();
			if (this.m_currentNode)
			{
				break;
			}

			var parentNode = this.m_treeWalker.parentNode();
			if (!parentNode)
			{
				result = this.globalNamespace.FAIL;
				break;
			}
		}
	}
	catch(e)
	{
		console.log(e);
		result = this.globalNamespace.FAIL;
	}
	return result;
}

/**
 * @brief Compares this object to another to determine their relative ordering.
 * @param [in]   obj                     The document cursor to compare to this object.
 * @return Object with three fields:
 *         resultCode              0 if successful, otherwise an error code.
 *         nodeCompare             Compare nodes w/o offsets. Negative if @a obj is less than this object, 0 if they are equal, or positive if it is greater.
 *         nodeWithOffsetsCompare  Compare nodes with offsets. Negative if @a obj is less than this object, 0 if they are equal, or positive if it is greater.
 */
SkypeClick2Call.DocumentCursor.prototype.Compare = function(obj)
{
	// result
	var result = {resultcode:this.globalNamespace.FAIL, nodeCompare:0, nodeWithOffsetsCompare:0};

	// compare root nodes. they should be the same
	var rootNode1 = this.m_treeWalker.root;
	var rootNode2 = obj.m_treeWalker.root;
	if (!rootNode1.isSameNode(rootNode2))
	{
		return result;
	}

	// compare curent nodes
	var currentNode1 = this.m_treeWalker.currentNode;
	var currentNode2 = obj.m_treeWalker.currentNode;

	if (currentNode1.isSameNode(currentNode2))
	{
		result.nodeCompare = 0;
		result.nodeWithOffsetsCompare = (this.m_beginOffset < obj.m_beginOffset ? -1 : (this.m_beginOffset == obj.m_beginOffset ? 0 : 1));
	}
	else
	{
		var compare = currentNode1.compareDocumentPosition(currentNode2);

		if ((compare & currentNode1.DOCUMENT_POSITION_CONTAINED_BY) || (compare & currentNode1.DOCUMENT_POSITION_FOLLOWING))
		{
			result.nodeCompare = result.nodeWithOffsetsCompare = -1;
		}
		else if ((compare & currentNode1.DOCUMENT_POSITION_CONTAINS) || (compare & currentNode1.DOCUMENT_POSITION_PRECEDING))
		{
			result.nodeCompare = result.nodeWithOffsetsCompare = 1;
		}
		else
		{
			return result;
		}
	}
	result.resultCode = 0;
	return result;
}

/// Compares position of cursors.
SkypeClick2Call.DocumentCursor.prototype.IsSamePosition = function(cursor)
{
	var compareResult = this.Compare(cursor);
	return (compareResult.resultcode == 0 && compareResult.nodeWithOffsetsCompare == 0);
}

/// Moves current cursor in backward direction on given number of text nodes.
SkypeClick2Call.DocumentCursor.prototype.MoveBackward = function(nodeCount)
{
	// move backward on nodeCount text nodes
	var node;
	while (nodeCount)
	{
		node = this.m_treeWalker.previousNode();
		if (!node)
		{
			break;
		}
		if (node.nodeType == node.TEXT_NODE)
		{
			--nodeCount;
		}
	}

	// reset offset to zero
	this.m_beginOffset = 0;

	// and change current node
	if (!node)
	{
		node = this.m_treeWalker.root;
	}
	this.m_currentNode = node;


	return this.globalNamespace.OK;
}


/**
 * @brief Moves the document cursor to the next node.
 * @return The object with three fields:
 *         resultCode    0 if everithing is OK, 1 if TreeWalker has no next node, otherwise an error code.
 *         node          The reference to the next DOM node.
 *         tagWasClosed  @c True if we moved to the parent node.
 */
SkypeClick2Call.DocumentCursor.prototype.MoveNext = function()
{
	var result = {resultCode:this.globalNamespace.FAIL, node:null, tagWasClosed:false};

	if (!this.m_treeWalker)
	{
		return result;
	}


	if (this.m_currentNode)
	{
		result.resultCode = this.globalNamespace.OK;
		result.node = this.m_currentNode;
		this.m_currentNode = null;
		return result;

	}

	// reset ofset inside TextNode
	this.m_beginOffset = 0;

	// copy 'm_skipFirstChild' attribute, and reset it
	var skipFirstChild = this.m_skipFirstChild;
	this.m_skipFirstChild = false;

	// move to the deepest first child
	if (!skipFirstChild)
	{
		var firstChild = this.m_treeWalker.firstChild();
		if (firstChild)
		{
			result.node = firstChild;
			result.resultCode = this.globalNamespace.OK;
			return result;
		}
	}

	// try to get next sibling
	while (true)
	{

		var nextNode = this.m_treeWalker.nextSibling();
		if (nextNode)
		{
			result.node = nextNode;
			result.resultCode = this.globalNamespace.OK;
			return result;
		}

		var parentNode = this.m_treeWalker.parentNode();
		if (!parentNode)
		{
			// move cursor to the end of the root node (this cursor can be re-used or compared with other cursors, so it must have valid position)
			this.MoveToTheEnd();

			result.resultCode = this.globalNamespace.EMPTY;
			return result;
		}

		this.m_skipFirstChild = true;

		result.tagWasClosed = true;
		result.node = parentNode;
		result.resultCode = this.globalNamespace.OK;
		return result;
	}

	return result; // this statement is never reached
}

/**
 * @brief Moves the document cursor to the end of the root node.
 * @return SkypeClick2Call.OK if everithing is OK, otherwise an error code.
 */
SkypeClick2Call.DocumentCursor.prototype.MoveToTheEnd = function()
{
	var rootNode = this.GetRootNode();
	var node = null;

	// text nodes does not have children, so it's a special case
	if (rootNode && rootNode.nodeType == rootNode.TEXT_NODE)
	{
		node = rootNode;
	}
	else
	{
		// move to the latest child
		while (this.m_treeWalker.lastChild())
		{
			// do nothing
		}
		node = this.m_treeWalker.currentNode;
	}

	// move begin offset to the end of the node
	if (node && node.nodeType == node.TEXT_NODE)
	{
		this.m_beginOffset = node.nodeValue.length;
	}

	return this.globalNamespace.OK;
}

//------------------------------------------------------------------------------



/**
 * @brief Constructor.
 * @param rootNode    The root node that used to set a search range if @a from or @a to point is @c null.
 * @param fromCursor  The search start point. Can be @c null (in this case the start point is equivalent to the start of the @a root node)
 * @param toCursor    The search end point. Can be @c null (in this case the end point is equivalent to the end of the @a root node)
 * @param listener    The listener that will be notified during iteration of the DOM tree.
 */
SkypeClick2Call.DocumentIterator = function(theGlobalNamespace, rootNode, fromCursor, toCursor, listener)
{
/*
	m_fromCursor;  ///< The start document cursor.
	m_toCursor;    ///< The end document cursor.
	m_listener;    ///< The listener that will be called during walking through the DOM tree.

*/
	//
	this.globalNamespace = theGlobalNamespace;

	this.m_fromCursor = fromCursor;
	this.m_toCursor   = toCursor;
	this.m_listener   = listener;

	// create cursors
	if (!this.m_fromCursor)
	{
		this.m_fromCursor = new this.globalNamespace.DocumentCursor(this.globalNamespace, rootNode, true);
	}
	if (!this.m_toCursor)
	{
		this.m_toCursor = new this.globalNamespace.DocumentCursor(this.globalNamespace, rootNode, false);
	}


}

/// Returns the start cursor.
SkypeClick2Call.DocumentIterator.prototype.GetFromCursor = function()
{
	return this.m_fromCursor;
}

/**
 * @brief Fires an event to the listener according to the Node type.
 * @param [in]  cursor        The current cursor.
 * @param [in]  node          The current node.
 * @param [in]  tagWasClosed  @c True if we moved to the parent node.
 * @return 0 if everithing is OK, otherwise an error code (1 or -1).
 */
SkypeClick2Call.DocumentIterator.prototype.Fire = function(cursor, node, tagWasClosed)
{
	// separate case for closed tags
	if (tagWasClosed)
	{
		this.m_listener.OnTagClosed(node);
		return this.globalNamespace.OK;
	}
	if (!node)
		return this.globalNamespace.FAIL;

	switch(node.nodeType)
	{
	case node.COMMENT_NODE:
		this.m_listener.OnCommentNode(node);
		break;
	case node.TEXT_NODE:
		var offsets = {beginOffset:0, endOffset:this.globalNamespace.npos};
		this.m_listener.OnTextNode(node, offsets);
		cursor.SetBeginOffset(offsets.beginOffset);
		break;
	case node.ELEMENT_NODE:
		this.m_listener.OnTagOpened(node);
		break;
	default:
		//alert("unsupported node - " + node.nodeType); /// ???
		//return SkypeClick2Call.FAIL;
	}

	return this.globalNamespace.OK;
}

/**
 * @brief Moves the document cursor through the next nodes and call listener.
 * @return 0 if everithing is OK, 1 if Tree Walker has no next node, otherwise an error code.
 */
SkypeClick2Call.DocumentIterator.prototype.Iterate = function()
{
	var result = this.globalNamespace.OK;
	var node;
	var tagWasClosed = false;

	// text nodes does not have children, so it's a special case
	if ((node = this.m_fromCursor.root) && node && node.nodeType == node.TEXT_NODE)
	{
		// in this case we will call listener with root node until listener say stop
		var nodeCompare, nodeWithOffsetsCompare;
		while (this.m_listener.CanContinue())
		{
			// compare nodes
			var compareResult = this.m_fromCursor.Compare(this.m_toCursor);
			if (compareResult.nodeWithOffsetsCompare >= 0)
			{
				break; // when 'from' is great than 'to'
			}

			var beginOffset = this.m_fromCursor.GetBeginOffset();
			// if nodes are equal, then set endOffest to the offset inside 'to' cursor
			var endOffset = (compareResult.nodeCompare == 0 ? this.m_toCursor.GetBeginOffset() : this.globalNamespace.npos);
			var offsets = {beginOffset:beginOffset, endOffset:endOffset};

			// call listener
			this.m_listener.OnTextNode(node, offsets);

			// move start offset
			this.m_fromCursor.SetBeginOffset(offsets.beginOffset);

			// if offsets are equal, then it means that there is no more text
			if (offsets.beginOffset == offsets.endOffset)
			{
				this.m_fromCursor = null;
				this.m_toCursor = null;
				result = this.globalNamespace.OK;
				break;
			}
		}
	}
	else
	{
		var moveResult = {resultCode: -1};
		// common case: just walk through all children
		while (this.m_listener.CanContinue())
		{
			moveResult = this.m_fromCursor.MoveNext();
			if (moveResult.resultCode != this.globalNamespace.OK)
			{
				result = moveResult.resultCode;
				break;
			}

			// compare nodes
			var compareResult = this.m_fromCursor.Compare(this.m_toCursor);
			if (compareResult.nodeCompare <= 0 && compareResult.nodeWithOffsetsCompare <= 0)
			{
				this.Fire(this.m_fromCursor, moveResult.node, moveResult.tagWasClosed);
			}

		}

		// clear cursor if there are no more nodes
		if (moveResult.resultCode == this.globalNamespace.EMPTY)
		{
			this.m_fromCursor = null;
			this.m_toCursor = null;
			result = this.globalNamespace.OK;
		}
	}

	return result;
}

// create META to inform contentscript.js that this file is ready
document.head.appendChild(document.createElement('meta')).name = "document_iterator.js";
