/**
 * @file
 * @brief JS implementation of the ChangeSink.
 * @note Uncomment lines commented like //t to enable spent time counting
 * in the mutation event collector.
 */

// create namespace
if (!window.SkypeClick2Call)
{
	window.SkypeClick2Call = {};
}

/**
 * @brief Creates new ChangeSink object.
 * @param  doc  Parent document.
 */
SkypeClick2Call.CreateChangeSink = function(doc)
{
//	console.log("SkypeClick2Call.CreateChangeSink");
//	console.log(this);
	return new this.ChangeSink(this, doc);
}

/**
 * @brief Constructor.
 * @param  doc  Parent document.
 */
SkypeClick2Call.ChangeSink = function(theGlobalNamespace, doc)
{
	//
	this.globalNamespace = theGlobalNamespace;

	this.NOTIFICATION_TIMER_DELAY = 200; // Timeout between handling mutation event and sending notification to C++.
	this.MAX_DELAYED_EVENTS       = 100; // Amount of mutation events to collect before explicitly sending notification to C++.

	this.m_doc           = doc;         // Parent document.
	this.m_injection     = false;       // True after BeginInjection was called and flase after EndInjection was called.
	this.m_injectionNode = null	        // Node marked as 'being modified' in BeginInjection.
	this.m_textNode      = null;        // Temporary variable to store node for DOMCharacterDataModified event during injection.
	this.m_timerId       = null;        // ID of the timer.
	this.m_modifiedNodes = new Array(); // List of modified nodes
	//t this.tcounter = 0.0;            // spent time in miliseconds during mutation event collecting.

	var self = this;
	this.on_event = function(e){self.EventHandler(e)};
	this.on_timer = function(){self.SendNotification()};
}

/**
 * @brief Adds or removes event listener (m_impl) to m_docEvents for events: DOMNodeInserted, DOMCharacterDataModified, DOMNodeRemoved.
 * @param [in] add Adds event listener
 * @return True if everything is OK, otherwise false.
 */
SkypeClick2Call.ChangeSink.prototype.AddRemoveListener = function(add)
{
	try
	{
		var el = this.m_doc.body;
		if (!el)
		{
			el = this.m_doc;
		}

		var events = [ "DOMNodeInserted",
                       "DOMCharacterDataModified"];

		for(var i = 0, length = events.length; i < length; i++)
		{
			if (add)
				el.addEventListener   (events[i], this.on_event, true)
			else
				el.removeEventListener(events[i], this.on_event, true)
		}
	}
	catch (e)
	{
		console.log("error: " + e);
	}
}


/**
 * Stops receiving update events for specific range. Call this method before do any manipulations
 * with DOM if you don't want receive events for this changes. This method will call
 * range->PrepareForInjection if range isn't null.
 * @param [in] node Domain html node for changes. May be null.
 * @return SST_OK if successful, or an error value otherwise.
*/
SkypeClick2Call.ChangeSink.prototype.BeginInjection = function(node)
{
	this.m_injection     = true;
	this.m_injectionNode = node;
}

/**
 * Starts receiving update events for specific range. Call this method after manipulations
 * with DOM done to start receiving events. This method will call range->RestoreAfterInjection
 * if range isn't null.
 * @param [in] node Domain html node for changes. May be null.
 * @return SST_OK if successful, or an error value otherwise.
*/
SkypeClick2Call.ChangeSink.prototype.EndInjection = function()
{
	this.m_injection     = false;
	this.m_injectionNode = null;
}

/// True, if BeginInjection was called and EndInjection wasn't.
SkypeClick2Call.ChangeSink.prototype.IsInjecting = function()
{
	return this.m_injection;
}


SkypeClick2Call.ChangeSink.prototype.EventHandler = function(event)
{
	//t var start_time = (new Date).getTime() - 1.0;	// round to upper integer value
	try
	{
		var newNode = event.target;
		var pushNode = true;

		if (this.m_injection)
		{
			// BeginInjection was called, so we should skip any C2C highlight node
			if (newNode.className &&
				(newNode.className.indexOf("skype_pnh") >= 0))
			{
				if (!m_injectionNode)
				{
					m_injectionNode = newNode.parentNode;
				}
				return;
			}

			// Ignore event if triggered from m_injectionNode or any of its child
			var relation = m_injectionNode.compareDocumentPosition(newNode);
			if ((m_injectionNode === newNode) ||
				(relation & Node.DOCUMENT_POSITION_CONTAINS))
				return;
		}

		// join nodes if JS makes multiple changes in DOM
		if (this.m_modifiedNodes.length > 0)
		{
			var lastNode = this.m_modifiedNodes[this.m_modifiedNodes.length - 1];
			var compare = lastNode.compareDocumentPosition(newNode);

			if (compare & this.globalNamespace.Node.DOCUMENT_POSITION_CONTAINED_BY)
			{
				// new node inside last one
				// do nothing with new node
				pushNode = false;
			}
			if (compare & this.globalNamespace.Node.DOCUMENT_POSITION_CONTAINS)
			{
				// new node contains last one
				// use new node instead of last one
				this.m_modifiedNodes[this.m_modifiedNodes.length - 1] = newNode;
				pushNode = false;
			}
			if (compare & this.globalNamespace.Node.DOCUMENT_POSITION_FOLLOWING)
			{
				if (newNode.isSameNode(lastNode.nextSibling))
				{
					// new node is the next sibling of the last node
					// use parent instead of last node. Make sure parent is not body,
					// otherwise we end up reprocessing the whole document.
					if (!lastNode.parentNode.isSameNode(document.body))
					{
						this.m_modifiedNodes[this.m_modifiedNodes.length - 1] = lastNode.parentNode;
						pushNode = false;
					}
				}
			}
			if (compare & this.globalNamespace.Node.DOCUMENT_POSITION_PRECEDING)
			{
				if (newNode.isSameNode(lastNode.previousSibling))
				{
					// new node is the previous sibling of the last node
					// use parent instead of last node. Make sure parent is not body,
					// otherwise we end up reprocessing the whole document.
					if (!lastNode.parentNode.isSameNode(document.body))
					{
						this.m_modifiedNodes[this.m_modifiedNodes.length - 1] = lastNode.parentNode;
						pushNode = false;
					}
				}
			}
		}

		if (pushNode)
		{
			this.m_modifiedNodes.push(event.target);
		}

		if (this.m_modifiedNodes.length == this.MAX_DELAYED_EVENTS)
		{
			// immediately send notification to the C++ part of the plugin
			// if we got enough delayed events
			clearTimeout(this.m_timerId);
			this.SendNotification();
		}
		else
		{
			// Not enough delayed events. Start timer to wait until we
			// get more events.
			clearTimeout(this.m_timerId);
			this.m_timerId = setTimeout(this.on_timer, this.NOTIFICATION_TIMER_DELAY);
		}
	}
	catch (e)
	{
		console.log("error: " + e);
	}
	finally
	{
		//t this.tcounter += (new Date).getTime() - start_time;
	}
}

/// Sends notification to the C++ part of the plugin
SkypeClick2Call.ChangeSink.prototype.SendNotification = function()
{
	var e = document.createEvent("Event");
	e.initEvent("SkypeToolbars_ChangeSink", false, true);
	e.modifiedNodes = this.m_modifiedNodes;
	this.m_modifiedNodes = new Array();
	//t e.tcounter = this.tcounter;
	//t console.log("time: " + this.tcounter.toString());
	//t this.tcounter = 0;
	document.dispatchEvent(e);
}

// create META to inform contentscript.js that this file is ready
document.head.appendChild(document.createElement('meta')).name = "change_sink.js";
